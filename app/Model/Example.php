<?php namespace App\Model;


use App\FromSky\DomainLayer\Media\Mediable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use App\FromSky\Translatable\GFTranslatableHelper;
use \App\FromSky\DomainLayer\Page\PagePresenter;

class Example extends Model
{
    use Translatable;
    use Mediable;
    use PagePresenter;
    use GFTranslatableHelper;

    protected $with = ['translations'];

    protected $fillable = [
        'title',
        'description',
        'description_2',
        'slug',
        'doc',
        'color',
        'date',
        'date_start',
        'date_end',
        'sort',
        'pub',
        'page_id',
        'page_2_id',
        'page_3_id',
        'status_id',
        'image_media_id'
    ];
    protected array $fieldspec = [];


    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */

    public array $translatedAttributes = [
        'title',
        'slug',
        'description',
        'description_2',
        'image',
        'image_media_id',
        'seo_title',
        'seo_description',
        'seo_no_index'
    ];

    public array $sluggable = ['slug' => ['field' => 'title', 'updatable' => false, 'translatable' => true]];


    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */

    public function page()
    {
        return $this->belongsTo('App\Model\Page', 'page_id', 'id');
    }

    public function page_2()
    {
        return $this->belongsTo('App\Model\Page', 'page_2_id', 'id');
    }

    public function pages()
    {
        return $this->belongsToMany('App\Model\Page', 'example_page', 'example_id', 'page_id');
    }

    public function savePages($values)
    {
        if (!empty($values)) {
            $this->pages()->sync($values);
        } else {
            $this->pages()->detach();
        }
    }

    /*
    |--------------------------------------------------------------------------
    |  DATE ATTRIBUTE
    |--------------------------------------------------------------------------
    */

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value);
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setDateStartAttribute($value)
    {
        $this->attributes['date_start'] = Carbon::parse($value);
    }

    public function getDateStartAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setDateEndAttribute($value)
    {
        $this->attributes['date_end'] = Carbon::parse($value);
    }

    public function getDateEndAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getFormattedDate()
    {
        //return Carbon::parse($this->attributes['date'])->formatLocalized('%d %B %Y');
        return Carbon::parse($this->attributes['date_start'])->format('Y-m-d H:i:s');
    }

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec(): array
    {
        $this->fieldspec['id']               = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];
        $this->fieldspec['page_id']          = [
            'type'        => 'relation',
            'model'       => 'Page',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'required'    => 0,
            'label'       => 'Relation with another model',
            'order_field' => 'title',
            'hidden'      => 0,
            'display'     => 1,

        ];
        $this->fieldspec['page_2_id']        = [
            'type'        => 'relation',
            'model'       => 'Page',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'required'    => 0,
            'label'       => 'Relation with another model and selectize',
            'hidden'      => 0,
            'display'     => 1,
            'cssClass'    => 'selectize',
        ];
        $this->fieldspec['page_3_id']        = [
            'type'        => 'relation_tree',
            'tree_field'  => 'parent_id',
            'order_field' => 'sort',
            'model'       => 'Page',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'required'    => false,
            'label'       => 'Relation tree with another model',
            'hidden'      => 0,
            'display'     => 1,
        ];
        $this->fieldspec['example_articles'] = [
            'type'               => 'relation_checkboxes',
            'model'              => 'Page',
            'relation_name'      => 'page',
            'foreign_key'        => 'id',
            'label_key'          => 'title',
            'label'              => 'CheckBoxes Multiple relation 222',
            'required'           => 0,
            'display'            => 1,
            'hidden'             => 0,
            'multiple'           => 0,
            'relationSaveMethod' => 'savePages',
            'order_raw'          => 'FIELD(id, %s)',
            'context'            => 'check_boxes'
        ];
        $this->fieldspec['title']            = [
            'type'           => 'vue_component',
            'required'       => 1,
            'validation'     => ['required', 'field_locale'],
            'hidden'         => 0,
            'label'          => 'Text',
            'display'        => 1,
            'component-name' => 'copyable-input-component',
            'component-data' => [
                'length'    => '10',
                'unique'    => true,
                'model'     => 'Example',
                'label'     => 'Genera Codice',
                'field'     => 'title',
                //'generator'=>'generatePin',
                'usePrefix' => true,
                'type'      => 'string'
            ]
        ];

        $this->fieldspec['date']       = [
            'type'            => 'string',
            'required'        => 0,
            'hidden'          => 0,
            'label'           => 'Date picker',
            'display'         => 1,
            'cssClass'        => 'datepicker',
            'cssClassElement' => 'col-sm-3',
        ];
        $this->fieldspec['date_range'] = [
            'type'            => 'component',
            'required'        => 1,
            'hidden'          => 0,
            'label'           => trans('admin.label.date_start'),
            'extramsg'        => '',
            'display'         => 1,
            'cssclass'        => 'datetimepicker',
            //'cssclass'  => 'datepicker',
            'cssclasselement' => 'col-lg-9',
            'validation'      => [
                'date_start' => ['required', 'date'],
                'date_end'   => ['required', 'date', 'after_or_equal:date_start']
            ],
            'default_value'   => carbon::tomorrow()->format('Y-m-d H:i:s h:s')
        ];
        $this->fieldspec['slug']       = [
            'type'           => 'vue_component',
            'component-name' => 'clearable-input-component',
            'required'       => 0,
            'hidden'         => 0,
            'label'          => 'Sluggable',
            'display'        => 1,
        ];
        $this->fieldspec['code']       = [
            'type'           => 'vue_component',
            'required'       => 1,
            'hidden'         => 0,
            'label'          => 'Code ',
            'display'        => 1,
            'extraMsg'       => 'you can use a prefix',
            'component-name' => 'generator-input-component',
            'component-data' => [
                'length'    => '10',
                'unique'    => true,
                'model'     => 'Example',
                'label'     => 'Genera Codice',
                'field'     => 'title',
                //'generator'=>'generatePin',
                'usePrefix' => true,
                'type'      => 'string'
            ]
        ];

        $this->fieldspec['password'] = [
            'type'           => 'vue_component',
            'required'       => 1,
            'hidden'         => 0,
            'label'          => 'Password',
            'display'        => 1,
            'component-name' => 'generator-input-component',
            'component-data' => [
                'length'    => '15',
                'unique'    => false,
                'label'     => 'Genera Password',
                'field'     => 'title',
                //'generator'=>'generatePin',
                'usePrefix' => false,
                'type'      => 'password'
            ]
        ];

        $this->fieldspec['description'] = [
            'type'     => 'text',
            'size'     => 600,
            'h'        => 300,
            'required' => 0,
            'hidden'   => 0,
            'label'    => 'Textarea',
            'display'  => 1,
        ];

        $this->fieldspec['description_2'] = [
            'type'     => 'text',
            'size'     => 600,
            'h'        => 300,
            'required' => 0,
            'hidden'   => 0,
            'label'    => 'Textarea WYSIWYG',
            'cssClass' => 'wysiwyg',
            'display'  => 1,
        ];

        $this->fieldspec['image'] = [
            'type'      => 'media',
            'required'  => 0,
            'hidden'    => 0,
            'label'     => 'File upload  Images',
            'mediaType' => 'Img',
            'disk'      => 'images',
            'folder'    => 'examples',
            'display'   => 1,
        ];

        $this->fieldspec['image_crop'] = [
            'type'      => 'media',
            'required'  => 0,
            'hidden'    => 0,
            'label'     => 'File upload with client-side crop',
            'mediaType' => 'Img',
            'display'   => 1,
            'cropper'   => [
                'width'     => 400,
                'height'    => 400,
                'ratio'     => 1,
                'fill'      => '#ffffff',
                'extension' => 'jpg'
            ]
        ];

        $this->fieldspec['doc'] = [
            'type'        => 'media',
            'required'    => 0,
            'hidden'      => 0,
            'label'       => 'File upload with ajax',
            'lang'        => 0,
            'mediaType'   => 'Doc',
            'display'     => 1,
            'uploadifive' => 1,
            'disk'        => 'media',
            'folder'      => 'docs'
        ];

        $this->fieldspec['color'] = [
            'type'     => 'color',
            'required' => 0,
            'hidden'   => 0,
            'label'    => 'Color picker',
            'display'  => 1,
        ];

        $this->fieldspec['image_media_id'] = [
            'type'      => 'fileManager',
            'required'  => false,
            'hidden'    => 0,
            'label'     => 'Image File Manager',
            'mediaType' => 'Img',
            'display'   => 1,
            //'collection'   => 'images', optional collection [images or docs]
        ];

        $this->fieldspec['map'] = [
            'type'            => 'component',
            'required'        => false,
            'hidden'          => 0,
            'label'           => 'Posizione',
            'extraMsg'        => '',
            'display'         => 1,
            'cssClassElement' => 'col-sm-10'
        ];

        $this->fieldspec['sort'] = [
            'type'     => 'integer',
            'required' => 0,
            'label'    => 'Number',
            'hidden'   => 0,
            'display'  => 1,
        ];

        $this->fieldspec['pub'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => 'Boolean',
            'display'  => 1,
            'context'  => 'check_boxes'
        ];

        $this->fieldspec['seo_title'] = [
            'type'     => 'seo_string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.seo.title'),
            'display'  => 1,
            'max'      => 65
        ];

        $this->fieldspec['seo_description'] = [
            'type'     => 'seo_text',
            'size'     => 600,
            'h'        => 300,
            'hidden'   => 0,
            'label'    => trans('admin.seo.description'),
            'cssClass' => 'no',
            'display'  => 1,
        ];

        $this->fieldspec['seo_no_index'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.seo.no-index'),
            'display'  => 1
        ];

        return $this->fieldspec;
    }
}
