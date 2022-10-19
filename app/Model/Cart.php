<?php namespace App\Model;


use App\FromSky\DomainLayer\Store\Cart\CartActionTrait;
use Illuminate\Database\Eloquent\Model;

use App\FromSky\DomainLayer\Store\Cart\CartPresenter;
use App\FromSky\DomainLayer\Store\Cart\CartStepTrait;


/**
 * Class Cart
 * @package App
 */
class Cart extends Model
{

    use CartPresenter,CartStepTrait, CartActionTrait;

    protected $fillable = ['user_id', 'status',
        'payment_method_id', 'shipping_cost', 'shipping_method_id',
        'billing_address_id', 'shipping_address_id','payment_fee',
        'discount_code', 'token'
    ];
    protected $fieldspec = [];

    protected $appends = ['discount_amount','discount_type','discount_label'];

    public array $sluggable = [];


    public function getRouteKeyName()
    {
        return 'token';
    }

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function discount()
    {
        return $this->belongsTo('App\Model\Discount', 'discount_code', 'code');
    }

    public function shipping_address()
    {
        return $this->belongsTo('App\Model\Address', 'shipping_address_id', 'id');
    }

    public function billing_address()
    {
        return $this->belongsTo('App\Model\Address', 'billing_address_id', 'id');
    }

    public function display_billing_address()
    {
        return ($this->billing_address_id != '') ? $this->billing_address() : $this->shipping_address();

    }

    public function cart_items()
    {
        return $this->hasMany('App\Model\CartItem');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\Model\PaymentMethod');
    }

    public function shipping_method()
    {
        return $this->belongsTo('App\Model\ShipmentMethod');
    }


    public function order()
    {
        return $this->hasOne('App\Model\Order');
    }


    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */

    function getFieldSpec(): array
    {
        return $this->fieldspec;
    }
}
