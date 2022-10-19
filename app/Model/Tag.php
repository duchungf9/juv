<?php namespace App\Model;

use App\FromSky\Builders\FromSkyCmsBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use App\FromSky\Translatable\GFTranslatableHelper;
use URL;

class Tag extends Model
{
    use Translatable;
    use GFTranslatableHelper;

    protected       $with      = ['translations'];
    protected       $fillable  = ['title', 'slug', 'description'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */

    public array $translatedAttributes = ['title','description', 'seo_title', 'seo_description', 'seo_keywords', 'seo_no_index'];
    public array $sluggable            = ['slug' => ['field' => 'title']];

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */

    public function news()
    {
        return $this->belongsToMany('App\Model\News');
    }

    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query)
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

        $this->fieldspec['id']          = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 'y',
            'required' => 1,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];
        $this->fieldspec['title']       = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => 'Title',
            'display'  => 1,
        ];
        $this->fieldspec['slug']        = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => 'Slug',
            'display'  => 1,
        ];
        $this->fieldspec['description'] = [
            'type'     => 'text',
            'size'     => 600,
            'h'        => 300,
            'required' => 1,
            'hidden'   => 0,
            'label'    => 'Description',
            'cssClass' => 'wysiwyg',
            'display'  => 1,
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

        $this->fieldspec['seo_keywords'] = [
            'type'     => 'seo_text',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.seo.keywords'),
            'display'  => 1,
            'max'      => 255
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

    /*
    |--------------------------------------------------------------------------
    |  This method return the tags permalink.
    |--------------------------------------------------------------------------
    */
    public function getPermalink()
    {
        return url_locale($this->slug);
    }

}
