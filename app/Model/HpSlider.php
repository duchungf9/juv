<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\FromSky\Builders\FromSkyCmsBuilder;

use Astrotomic\Translatable\Translatable;
use App\FromSky\Translatable\GFTranslatableHelper;

class HpSlider extends Model
{

    use Translatable;
    use  GFTranslatableHelper;

    protected $table = 'hpsliders';
    protected $fillable = ['title', 'description',  'link', 'sort', 'is_active'];
    protected array $fieldspec = [];
    protected $with = ['translations'];
    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = [
        'title', 'description'
    ];

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
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec(): array
    {

       
        $this->fieldspec['id'] = [
            'type' => 'integer',
            'minvalue' => 0,
            'pkey' => 1,
            'required' => 1,
            'label' => trans('admin.label.id'),
            'hidden' => 1,
            'display' => 0,
        ];
        $this->fieldspec['title'] = [
            'type' => 'string',
            'required' => 1,
            'hidden' => 0,
            'label' => trans('admin.label.title'),
            'display' => 1,
        ];

        $this->fieldspec['description'] = [
            'type' => 'string',
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.description'),
            'lang' => 0,
            'cssClass' => 'wysiwyg',
            'display' => 1,
        ];

        $this->fieldspec['link'] = [
            'type' => 'string',
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.link'),
            'display' => 1,
        ];
        $this->fieldspec['image'] = [
            'type' => 'media',
            'pkey' => 0,
            'required' => 1,
            'hidden' => 0,
            'label' => trans('admin.label.image'),
            'mediaType' => 'Img',
            'display' => 1,
        ];
        $this->fieldspec['sort'] = [
            'type' => 'integer',
            'required' => 0,
            'label' => trans('admin.label.position'),
            'hidden' => 0,
            'display' => 1,
        ];
        $this->fieldspec['is_active'] = [
            'type' => 'boolean',
            'pkey' => 0,
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.publish'),
            'display' => 1
        ];
        return $this->fieldspec;
    }

}
