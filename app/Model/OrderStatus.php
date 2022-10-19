<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

use App\FromSky\Translatable\GFTranslatableHelper;;

class OrderStatus extends Model

{
    use HasFactory;
    use GFTranslatableHelper;
    use Translatable;
    protected $table = 'order_status';

    protected $with = ['translations'];

    protected $fillable = [
        'title',
        'description',
        'sort',
        'is_active'
    ];

    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = [
        'title',
        'description'
    ];

    public array $sluggable = [
        'slug' => ['field' => 'title', 'updatable' => false, 'translatable' => 1]
    ];

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */
    

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec(): array
    {
        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => trans('admin.label.id'),
            'hidden'   => 1,
            'display'  => 0,
        ];

        $this->fieldspec['title'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.title'),
            'display'  => 1,
        ];

        $this->fieldspec['description'] = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'size'     => 600,
            'h'        => 300,
            'label'    => trans('admin.label.description'),
            'display'  => 1,
            'cssClass' => 'wysiwyg',
        ];

        $this->fieldspec['sort'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => trans('admin.label.sort'),
            'hidden'   => 0,
            'display'  => 1,
        ];

        $this->fieldspec['is_active'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.pub'),
            'display'  => 1,
        ];

        return $this->fieldspec;
    }
}
