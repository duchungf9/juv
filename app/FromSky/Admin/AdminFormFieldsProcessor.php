<?php

namespace App\FromSky\Admin;


use App\FromSky\Admin\Helpers\AdminDynamicsAttributesSaver;
use App\FromSky\Admin\Helpers\AdminRelationsSaverTrait;
use App\FromSky\Admin\Helpers\AdminUserTrackerTrait;
use App\FromSky\Searchable\SearchableTrait;
use App\FromSky\Sluggable\SluggableTrait;
use App\FromSky\Tools\UploadManager;

/**
 * Class AdminFormFieldsProcessor
 * @package App\FromSky\Admin
 */
class AdminFormFieldsProcessor
{

    use AdminUserTrackerTrait;
    use AdminRelationsSaverTrait;
    use AdminDynamicsAttributesSaver;
    use SluggableTrait;
    use SearchableTrait;

    /**
     * @var
     */
    protected $model;
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $fieldSpecs;

    /**
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param $model
     */
    public function requestFieldHandler($model)
    {

        $field            = '';
        $this->fieldSpecs = collect($model->getFieldspec());
        $changes_log = [];
        foreach ($model->getFillable() as $field) {
            if ($this->request->has($field)) {
                if($model->$field != $this->request->get($field)){
                        $changes_log[$field] = ['original'=>$model->{$field},'changes'=>$this->request->get($field)];
                }
                $model->$field = $this->request->get($field);

            }
        }

        if (isset($model->sluggable)) {
            foreach ($model->sluggable as $key => $field) {
                if (!$this->slugIsTranslatable($field)) {
                    $slug_value   = $this->request->get($key);
                    $source_value = $this->request->get($field['field']);
                    $model->$key  = $this->setSlugAttributes($field)
                        ->sluggy($model, $slug_value, $source_value);
                }
            }
        }

        /** keeps track of the user who made the changes */
        $this->hackedBy($model);

        $this->processMedia($model);

        $model->save();

        reFlushAdmin();// reflush cache

        activity()->performedOn($model)->causedBy(auth()->guard("admin")->user())->withProperties(['changes_log'=>$changes_log])->log("Đã cập nhật ");

        /**
         * Save relation ship
         */
        $this->relationsSaver($model);

        $this->translationHandlers($model, $field);

//        $this->dynamicsAttributeSaver($model);
    }


    /**
     * SAVE TRANSLATIONS
     * @param $model
     * @param $field
     */
    function translationHandlers($model, $field)
    {
        // translatable
        $changes_log = [];
        if (isset($model->translatedAttributes) && count($model->translatedAttributes) > 0) {
            foreach (config('app.locales') as $locale => $value) {
                foreach ($model->translatedAttributes as $attribute) {
                    // se è un attributo sluggable;
                    if (isset($model->sluggable) && $this->attributeIsSluggable($attribute, $model->sluggable)) {
                        $attribute_to_slug = (config('app.locale') != $locale) ? $attribute . '_' . $locale : $attribute;
                        $string_value      = $this->setSlugAttributes($field)
                            ->sluggyTranslatable($model, $this->request->get($attribute_to_slug), $locale);

                        $model->translateOrNew($locale)->$attribute = $string_value;
                    } elseif ($model->getFieldSpec()[$attribute]['type'] != 'media') {
                        if (config('app.locale') != $locale) {
                            $model->translateOrNew($locale)->$attribute = $this->request->get($attribute . '_' . $locale);
                        } else {
                            $model->translateOrNew($locale)->$attribute = $this->request->get($attribute);
                        }
                    }
                }
                $model->save();
            }
        }
    }


    /**
     * @param $model
     */
    private function processMedia($model)
    {
        foreach ($this->fieldSpecs->where('type', 'media')->all() as $key => $field) {
            $disk   = data_get($field, 'disk', '');
            $folder = data_get($field, 'folder', '');

            if ($this->isTranslatableField($key)) {
                foreach (config('app.locales') as $locale => $value) {
                    $this->mediaHandlerLocale($model, $key, $disk, $folder, $locale);
                    $model->save();
                }
            } else {
                (isset($field['cropper'])) ? $this->cropperHandler($model, $key, $disk,
                    $folder) : $this->mediaHandler($model, $key, $disk, $folder);
            }
        }
    }


    /**
     * Perform the media upload
     * @param $model
     * @param $media
     */
    private function mediaHandler($model, $media, $disk = '', $folder = '')
    {
        $UM = new UploadManager;

        $model->$media = ($UM->init($media, $this->request, $disk, $folder)->store()->getFileFullName()) ?: $model->$media;
    }

    /**
     * @param $model
     * @param $media
     * @param string $disk
     * @param string $folder
     * @param $locale
     */
    private function mediaHandlerLocale($model, $media, $disk = '', $folder = '', $locale)
    {
        $UM                                     = new UploadManager;
        $media_locale                           = (config('app.locale') != $locale) ? $media . '_' . $locale : $media;
        $model->translateOrNew($locale)->$media = ($UM->init($media_locale, $this->request, $disk,
            $folder)->store()->getFileFullName()) ?: $model->translateOrNew($locale)->$media;

    }

    /**
     * @param $model
     * @param $media
     * @param string $disk
     * @param string $folder
     * @return false|void
     * @throws \Exception
     */
    private function cropperHandler($model, $media, $disk = '', $folder = '')
    {
        $data = $this->request->$media;

        if (!$data) {
            return false;
        }

        $config = $model->getFieldSpec();
        $config = $config[$media];
        $config = collect($config['cropper']);

        $disk   = $disk ?: 'media';
        $folder = $folder ?: 'images';

        $UM           = new UploadManager;
        $file_details = ($UM->init($media, $this->request, $disk, $folder)->storeData($data,
            $this->request->{$media . '-filename'}, $config));

        $model->$media = $file_details['fullName'] ?: $model->$media;
    }
}
