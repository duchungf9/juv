<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;


use App\FromSky\DomainLayer\Store\OrderNotificationPresenter;
use App\FromSky\DomainLayer\Store\OrderPresenter;

class Order extends Model
{
    use OrderPresenter;
    use OrderNotificationPresenter;

    const ORDER_STATUS_SENT = 1;

    public function getRouteKeyName(): string
    {
        return 'token';
    }

    protected $fillable = [
        'user_id',
        'cart_id',
        'payment_id',
        'payment_fee',
        'status_id',
        'shipping_method_id',
        'shipping_method',
        'reference',
        'products_cost',
        'shipping_cost',
        'discount_amount',
        'vat_cost',
        'total_cost',
        'billing_address_id',
        'shipping_address_id',
        'billing_formatted_address',
        'shipping_formatted_address',
        'discount_code',
        'reference',
        'token',
    ];
    protected array $fieldspec = [];

    public array $sluggable = [];

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */

    public function cart()
    {
        return $this->belongsTo('App\Model\Cart');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function order_items()
    {
        return $this->hasMany('App\Model\OrderItem');
    }

    public function payment()
    {
        return $this->hasOne('App\Model\Payment');
    }

    public function billing_address()
    {
        return $this->belongsTo('App\Model\Address', 'billing_address_id');
    }

    public function shipping_address()
    {
        return $this->belongsTo('App\Model\Address', 'shipping_address_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Model\OrderStatus', 'status_id');
    }

    public function discount()
    {
        return $this->belongsTo('App\Model\Discount', 'discount_code', 'code');
    }

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */

    function getFieldSpec()
    {
        return $this->fieldspec;
    }

    public function scopeList($query)
    {
        return $query->with(['order_items', 'payment', 'billing_address', 'shipping_address']);
    }


    public function getUserDisplayAttribute()
    {
        return $this->user->name;
    }

    public function getProductsDisplayAttribute(): string
    {
        $products = [];
        foreach ($this->order_items()->get() as $_item) {
            $products[] = $_item->quantity . 'x ' . $_item->product_description;
        }
        return implode('<br>', $products);
    }

    public function getPaymentMethodDisplayAttribute()
    {
        $payment = $this->payment;
        return  ($payment)
            ? $payment->payment_method->title
            :'';
    }

}
