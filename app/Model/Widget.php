<?php namespace App\Model;

use App\FromSky\Builders\WidgetBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use \App\FromSky\Translatable\GFTranslatableHelper;;
use Astrotomic\Translatable\Translatable;

class Widget extends Model

{
    use HasFactory;
    use GFTranslatableHelper;
    use Translatable;

    protected $with = ['translations'];

    public array $clone_exempt_attributes = ['code'];

    protected $fillable = [
        'type_id',
        'category_id',
        'code',
        'title',
        'subtitle',
        'btn_title',
        'description',
        'icon',
        'image',
        'video',
        'link',
        'is_active',
        'is_one_time',
        'sort'
    ];

    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = [
        'title',
        'subtitle',
        'btn_title',
        'description',
        'link',
    ];

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */

    /*public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id', 'id')->where('model_type', Widget::class);
    }*/


    public function types()
    {
        return $this->belongsTo('App\Type');
    }


    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query): WidgetBuilder
    {
        return new WidgetBuilder($query);
    }


    /*
    |--------------------------------------------------------------------------
    |  Fieldspec
    |--------------------------------------------------------------------------
    */
    function getFieldSpec()
    {
        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => __('admin.label.id'),
            'hidden'   => 1,
            'display'  => 0,
        ];

        /*$this->fieldspec['type_id'] = [
            'type'          => 'relation',
            'model'         => 'Type',
            //'relation_name' => 'types',
            'foreign_key'   => 'id',
            'label_key'     => 'title',
            'order_field'   => 'sort',

            'required' => 0,
            'hidden'   => 0,
            'display'  => 1,
            'label'    => __('admin.label.type_id'),
            'cssClass' => 'selectize',
        ];*/

        $this->fieldspec['code'] = [
            'type'     => ($this->id && !isSu())?"readonly":"string",
            'required' => 1,
            'hidden'   => 0,
            'label'    => __('admin.label.code'),
            'display'  => 1,
            'cssClassElement' => 'col-md-4 col-lg-4',
        ];

        $this->fieldspec['title'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => __('admin.label.title'),
            'display'  => 1,
        ];

       /* $this->fieldspec['category_id'] = [
            'type'        => 'relation',
            'model'       => 'Category',
            'filter'      => ['model_type' => Widget::class],
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'label'       => trans('admin.label.category'),
            'hidden'      => 0,
            'required'    => false,
            'display'     => 1,
        ];*/

        $this->fieldspec['subtitle'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.subtitle'),
            'display'  => 1,
        ];

        $this->fieldspec['btn_title'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.btn_title'),
            'display'  => 1,
        ];

        $this->fieldspec['description'] = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'size'     => 600,
            'h'        => 300,
            'label'    => __('admin.label.description'),
            'display'  => 1,
            'cssClass' => 'wysiwyg',
        ];

        $this->fieldspec['icon'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.icon'),
            'display'  => 1,
        ];

        $this->fieldspec['image'] = [
            'type'      => 'media',
            'required'  => 0,
            'hidden'    => 0,
            'label'     => __('admin.label.image'),
            'mediaType' => 'Img',
            'display'   => 1,
            'disk'      => 'media',
            //'accept'	=> '.jpg,png,gif'
       ];

        $this->fieldspec['video'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.video'),
            'display'  => 0,
        ];

        $this->fieldspec['link'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.link'),
            'display'  => 1,
            'extraMsg' =>__('admin.help.field_link')
        ];

        $this->fieldspec['is_one_time'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.is_one_time'),
            'display'  => 1,
        ];

        $this->fieldspec['is_active'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => __('admin.label.is_active'),
            'display'  => 1,
        ];

        $this->fieldspec['sort'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'required' => 0,
            'label'    => __('admin.label.sort'),
            'hidden'   => 0,
            'display'  => 1,
            'cssClassElement' => 'col-md-4 col-lg-4',
        ];

        return $this->fieldspec;
    }
}
