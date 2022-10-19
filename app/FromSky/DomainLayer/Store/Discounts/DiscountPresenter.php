<?php


namespace App\FromSky\DomainLayer\Store\Discounts;

use App\FromSky\Definition\Definition;
use Carbon\Carbon;

trait DiscountPresenter
{

    /*
	|--------------------------------------------------------------------------
	|  DATE ATTRIBUTE
	|--------------------------------------------------------------------------
	*/
    public function setDateStartAttribute($value)
    {
        if ($value) {
            $this->attributes['date_start'] = Carbon::parse($value);
        }
    }

    public function getDateStartAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('Y-m-d H:i:s');
        }
    }

    public function getFormattedDateStart()
    {
        return Carbon::parse($this->attributes['date_start'])->format('Y-m-d H:i:s');
    }

    public function setDateEndAttribute($value)
    {
        if ($value) {
            $this->attributes['date_end'] = Carbon::parse($value);
        }
    }

    public function getDateEndAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('Y-m-d H:i:s');
        }
    }

    public function getFormattedDateEnd()
    {
        return Carbon::parse($this->attributes['date_end'])->format('Y-m-d H:i:s');
    }


    /*
	|--------------------------------------------------------------------------
	|  AMOUNT
	|--------------------------------------------------------------------------
	*/

    function getLabelAttribute()
    {
        return $this->amount . '' . $this->getSign();
    }

    function getSign()
    {
        return ($this->type == self::AMOUNT) ? '€' : '%';
    }
}