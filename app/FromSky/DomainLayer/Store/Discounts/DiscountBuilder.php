<?php


namespace App\FromSky\DomainLayer\Store\Discounts;


use App\FromSky\Builders\FromSkyCmsBuilder;

class DiscountBuilder extends FromSkyCmsBuilder
{
    /**
     * @param $code
     * @return FromSkyCmsBuilder
     */
    public function getByCode($code): FromSkyCmsBuilder
    {
        return $this->active()->where('code', strtoupper($code));
    }


}