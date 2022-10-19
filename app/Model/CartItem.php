<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
		'cart_id',
		'product_code',
		'product_model_code',
		'quantity'
    ];
    protected array $fieldspec = [];

    public array $sluggable = [];

	public function product()
	{
		return $this->belongsTo('App\Model\Product', 'product_code', 'code');
	}

	public function product_model()
	{
		return $this->belongsTo('App\Model\ProductModel', 'product_model_code', 'code');
	}

	public function cart()
	{
		return $this->belongsTo('App\Model\Cart');
	}

	public function order_item()
	{
		return $this->hasOne('App\Model\OrderItem');
	}

    function getFieldSpec(): array
    {
        return $this->fieldspec;
    }

	public function scopeList($query)
	{
		return $query->with('product')->orderBy('created_at');
	}
}
