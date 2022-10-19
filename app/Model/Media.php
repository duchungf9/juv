<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\FromSky\Tools\StringHelper;
use App\FromSky\Builders\MediaBuilder;
use App\FromSky\DomainLayer\Media\MediaPresenter;

use Astrotomic\Translatable\Translatable;
use App\FromSky\Translatable\GFTranslatableHelper;

class Media extends Model
{

    use MediaPresenter;
    use Translatable;
    use GFTranslatableHelper;

    protected $table = 'media';
    protected $fillable = [
        'title','description',
        'sort','media_category_id',
        'pub','is_home',
        'video','collection_name'
    ];

    public array $translatedAttributes = ['title','alt','description'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query): MediaBuilder
    {
        return new MediaBuilder($query);
    }

    public function media(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function media_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Model\Template', 'media_category_id', 'id');
    }


    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec(): array
    {

        $this->fieldspec['id'] = [
            'type' => 'integer',
            'minvalue' => 0,
            'pkey' => 'y',
            'required' => true,
            'label' => 'id',
            'hidden' => 1,
            'display' => 1,
        ];
//        $this->fieldspec['file_name'] = [
//            'type' => 'string',
//            'required' => true,
//            'hidden' => 0,
//            'label' => 'File name',
//            'lang' => 0,
//            'display' => 1,
//
//        ];

        $this->fieldspec['collection_name'] = [
            'type' => 'select',
            'select_data'=>['videos'=>'videos','images'=>'images'],
            'required' => false,
            'hidden' => 0,
            'label' => 'Type',
            'lang' => 0,
            'display' => 1,

        ];

        $this->fieldspec['video'] = [
            'type' => 'string',
            'required' => false,
            'hidden' => 0,
            'label' => 'youtube video embed code',
            'lang' => 0,
            'display' => 1,

        ];

        $this->fieldspec['media_category_id'] = [
            'type' => 'relation',
            'model' => 'Template',
            'filter' => ['template' => 'imagetype'],
            'foreign_key' => 'id',
            'label_key' => 'title',
            'label' => 'Media Category',
            'hidden' => 0,
            'required' => false,
            'display' => 1,
        ];
        $this->fieldspec['title'] = [
            'type' => 'string',
            'required' => true,
            'hidden' => 0,
            'label' => 'Title',
            'display' => 1,
        ];
        $this->fieldspec['alt'] = [
            'type' => 'string',
            'required' => false,
            'hidden' => 0,
            'label' => 'Alt',
            'display' => 1,
        ];
        $this->fieldspec['description'] = [
            'type' => 'text',
            'size' => 600,
            'h' => 100,
            'required' => false,
            'hidden' => 0,
            'label' => 'Description',
            'cssClass' => 'smallArea',
            'display' => 1,
        ];
        $this->fieldspec['sort'] = [
            'type' => 'integer',
            'required' => false,
            'label' => 'Order',
            'hidden' => 0,
            'display' => 1,
        ];

        $this->fieldspec['pub'] = [
            'type' => 'boolean',
            'pkey' => 'n',
            'required' => false,
            'hidden' => 0,
            'label' => trans('admin.label.publish'),
            'display' => 1
        ];
        $this->fieldspec['is_home'] = [
            'type' => 'boolean',
            'pkey' => 'n',
            'required' => false,
            'hidden' => 0,
            'label' => "Is Home",
            'display' => 1
        ];

        return $this->fieldspec;
    }







    public function url()
    {
        switch ($this->collection_name) {
            case 'images':
                return ma_get_image_from_repository($this->file_name);
                break;
            case 'docs':
                return ma_get_doc_from_repository($this->file_name);
                break;
        }
    }

    public function path()
    {
        switch ($this->collection_name) {
            case 'images':
                return ma_get_image_path_from_repository($this->file_name);
                break;
            case 'docs':
                return ma_get_doc_path_from_repository($this->file_name);
                break;
        }
    }

    public function getFileSize()
    {
        return StringHelper::humanReadableFileSize($this->size);
    }
    /* TODO */
    public function canBeDeleted()
    {
       return true;
    }
}
