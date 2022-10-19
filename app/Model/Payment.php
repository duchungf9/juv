<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
	use SoftDeletes;

    protected $fillable = [
		'order_id',
		'payment_method_id',
		'code',
		'transaction',
		'notes',
    ];
	protected $dates = ['deleted_at'];
    protected $fieldspec = [];

    public $sluggable = [];

	public function order()
	{
		return $this->belongsTo('App\Model\Order');
	}

	public function payment_method()
	{
		return $this->belongsTo('App\Model\PaymentMethod');
	}

    function getFieldSpec()
    {
        return $this->fieldspec;
    }
}
