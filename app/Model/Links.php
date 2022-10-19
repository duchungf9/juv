<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use App\FromSky\Translatable\GFTranslatableHelper;

use App\FromSky\DomainLayer\Media\Mediable;
use App\FromSky\DomainLayer\Block\Blockable;
use App\FromSky\Builders\PageBuilder;
use \App\FromSky\DomainLayer\Page\PagePresenter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JetBrains\PhpStorm\Pure;


/**
 * Class Page
 * @package App
 */
class Links extends Model
{
    use Translatable;
    use GFTranslatableHelper;


    protected $with = ['translations'];
    public array $cloneable_relations= ['translations'];


    protected $fillable = [
        'title', 'subtitle','image',
        'link', 'sort', 'pub',
    ];


    protected array $fieldspec = [];


    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = [
        'title','subtitle',
    ];




    /*
    |--------------------------------------------------------------------------
    |  RELATIONS
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    #[Pure] function newEloquentBuilder($query): PageBuilder
    {
        return new PageBuilder($query);
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
            // uncomment if you want validate all title fields
            //'validation'=>['required','field_locale'],
            'hidden' => 0,
            'label' => trans('admin.label.title'),
            'display' => 1,
        ];

        $this->fieldspec['subtitle'] = [
            'type' => 'string',
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.subtitle'),
            'display' => 1,
        ];


        $this->fieldspec['link'] = [
            'type' => 'string',
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.ext_url'),
            'display' => 1,
            'validation' => ['required', 'url']
        ];


        $this->fieldspec['sort'] = [
            'type' => 'integer',
            'required' => 0,
            'label' => trans('admin.label.position'),
            'hidden' => 0,
            'display' => 1,
            'cssClassElement' => 'col-md-1 col-lg-1',

        ];
        $this->fieldspec['pub'] = [
            'type' => 'boolean',
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.publish'),
            'display' => 1,
            'cssClassElement' => 'col-md-2 col-lg-2',
        ];


        return $this->fieldspec;
    }
}
