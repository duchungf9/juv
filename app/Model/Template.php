<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use App\FromSky\Translatable\GFTranslatableHelper;

use App\FromSky\Builders\TemplateBuilder;
use App\FromSky\Builders\PageBuilder;

/**
 * Class Template
 * @package App
 */
class Template extends Model
{
    use Translatable;
    use GFTranslatableHelper;

    protected $with = ['translations'];
    public array $translatedAttributes = ['title'];
    protected $fillable  = ['template','title','value','pub','sort'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query): TemplateBuilder
    {
        return new TemplateBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec (): array
    {

        $this->fieldspec['id'] = [
            'type'      => 'integer',
            'minvalue'  => 0,
            'pkey'      => 1,
            'required'  => true,
            'label'     => trans('admin.label.id'),
            'hidden'    => 1,
            'display'   => 0,
        ];

        $this->fieldspec['template'] = [
            'type'      => 'string',
            'required'  => true,
            'hidden'    => 0,
            'label'     => trans('admin.label.domain'),
            'display'   => 1,
        ];

        $this->fieldspec['title'] = [
            'type'      => 'string',
            'required'  => true,
            'hidden'    => 0,
            'label'     => trans('admin.label.title'),
            'display'   => 1,
        ];

        $this->fieldspec['value'] = [
            'type'      => 'string',
            'required'  => true,
            'hidden'    => 0,
            'label'     => trans('admin.label.value'),
            'display'   => 1,
        ];

        $this->fieldspec['sort'] = [
            'type'      => 'integer',
            'required'  => 0,
            'label'     => trans('admin.label.position'),
            'hidden'    => 0,
            'display'   => 1,
        ];

        $this->fieldspec['pub'] = [
            'type'      => 'boolean',
            'pkey'      => 0,
            'required'  => 0,
            'hidden'    => 0,
            'label'     => trans('admin.label.publish'),
            'display'   => 1
        ];
        return $this->fieldspec;
    }
}
