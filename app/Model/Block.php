<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use App\FromSky\Translatable\GFTranslatableHelper;

use App\FromSky\DomainLayer\Media\Mediable;
use App\FromSky\Builders\FromSkyCmsBuilder;
use App\FromSky\DomainLayer\Block\BlockPresenter;


/**
 * Class Block
 * @package App
 */
class Block extends Model
{
    use Translatable;
    use GFTranslatableHelper;
    use BlockPresenter;
    use Mediable;

    protected $with = ['translations'];

    public array $cloneable_relations= ['translations'];

    protected $fillable = [
        'model_id',
        'model_type',
        'template_id',
        'btn_title',
        'title',
        'subtitle',
        'description',
        'color',
        'doc',
        'image',
        'video',
        'link',
        'sort',
        'pub',
        'translatables',
        'created_by', 'updated_by'
    ];
    protected array $fieldspec = [];


    /*
    |--------------------------------------------------------------------------
    |  RELATIONS
    |--------------------------------------------------------------------------
    */

    public function model()
    {
        return $this->morphTo();
    }

    public function media()
    {
        return $this->morphMany('App\Model\Media', 'model');
    }
    public function template()
    {
        return $this->belongsTo('App\Model\Template', 'template_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query): FromSkyCmsBuilder
    {
        return new FromSkyCmsBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = [
        'title',
        'description',
        'subtitle',
        'btn_title'
    ];

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec()
    {
        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];
        $this->fieldspec['model_type'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 1,
            'label'    => "Type",
            'display'  => 1,
            'default_value' => $this->resolveMorphModelClass()
        ];
        $this->fieldspec['model_id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => 'model_id',
            'hidden'   => 1,//request()->has('model_id'),
            'display'  => 1,
            'default_value' => request()->get('model_id')
        ];
        $this->fieldspec['template_id'] = [
            'type'        => 'relation',
            'model'       => 'Template',
            'filter'      => ['template' => 'block_template'],
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'required'    => 0,
            'label'       => trans('admin.label.template'),
            'hidden'      => 0,
            'display'     => 1,
        ];
        $this->fieldspec['title'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.title'),
            'display'  => 1,
        ];
        $this->fieldspec['subtitle'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.subtitle'),
            'display'  => 1,
        ];

        $this->fieldspec['description'] = [
            'type'     => 'text',
            'size'     => 600,
            'h'        => 300,
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.description'),
            'cssClass' => 'wysiwyg',
            'display'  => 1,
        ];
        $this->fieldspec['btn_title'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.btn_title'),
            'display'  => 1,
            'cssClassElement' => 'col-md-4 col-lg-4',

        ];
        $this->fieldspec['link'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.btn_link'),
            'display'  => 1,

        ];
        $this->fieldspec['image'] = [
            'type'      => 'media',
            'required'  => 0,
            'hidden'    => 0,
            'label'     => trans('admin.label.image'),
            'mediaType' => 'Img',
            'display'   => 1,
            'disk'      => 'media',

        ];

        $this->fieldspec['doc'] = [
            'type'        => 'media',
            'required'    => 0,
            'hidden'      => 0,
            'label'       => trans('admin.label.doc'),
            'lang'        => 0,
            'mediaType'   => 'Doc',
            'display'     => 1,
            'uploadifive' => 1,
            'accept'	=> '.pdf'
        ];
        $this->fieldspec['video'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "YouTube video code",
            'display'  => 1,
        ];
        $this->fieldspec['sort'] = [
            'type'     => 'integer',
            'required' => 0,
            'label'    => trans('admin.label.position'),
            'hidden'   => 0,
            'display'  => 1,
        ];
        $this->fieldspec['pub'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish'),
            'display'  => 1
        ];

        return $this->fieldspec;
    }

    function  resolveMorphModelClass(){
        $model = (request()->has('model'))?request()->get('model'):'page';

        return get_class(getModelFromString($model));
    }
}
