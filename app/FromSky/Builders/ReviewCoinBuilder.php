<?php

namespace App\FromSky\Builders;


use App\Model\ReviewCoin;
use App\Model\ReviewCoinAttributes;
use App\Model\NewsAttributesValue;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 */
class ReviewCoinBuilder extends FromSkyCmsBuilder
{
    /**
     * @param int $limit
     * @return ReviewCoinBuilder
     */
    public function allAttrByLocaleAndLimit(int $limit = 6)
    {
        return $this->without('reviewCoinAttributesValue')->limit($limit)->orderBy('sort');
    }
}
