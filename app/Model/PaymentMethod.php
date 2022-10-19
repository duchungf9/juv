<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\FromSky\Builders\FromSkyCmsBuilder;
use App\FromSky\Translatable\GFTranslatableHelper;
use App\FromSky\DomainLayer\Store\Payment\PaymentMethodPresenter;

class PaymentMethod extends Model

{
    use HasFactory;
    use GFTranslatableHelper;
    use Translatable;
    use PaymentMethodPresenter;
    const PAYPAL= 1;
    const BANK_TRANSFER = 2;
    const CASH          = 3;

    protected $with = ['translations'];

    protected $fillable = [
        'title',
        'description',
        'fee',
        'free_from',
        'note',
        'code',
        'is_active',
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
        'description',
        'note'
    ];

    public array $sluggable = [];

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

        $this->fieldspec['code'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.code'),
            'display'  => 1,
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

        $this->fieldspec['note'] = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'size'     => 600,
            'h'        => 300,
            'label'    => trans('admin.label.note'),
            'display'  => 1,
            'cssClass' => 'wysiwyg',
        ];

        $this->fieldspec['fee'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.fee'),
            'display'  => 1,
            'cssClassElement' => 'col-md-3',
            'row-item' => 'start'
        ];

        $this->fieldspec['free_from'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 0,
            'label'    => trans('admin.label.free_shipping_from'),
            'hidden'   => 0,
            'display'  => 1,
            'cssClassElement' => 'col-md-3',
            'row-item' => 'stop'
        ];



        $this->fieldspec['is_active'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.is_active'),
            'display'  => 1,
        ];

        $this->fieldspec['sort'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 0,
            'label'    => trans('admin.label.sort'),
            'hidden'   => 0,
            'display'  => 1,
        ];

        return $this->fieldspec;
    }
}
