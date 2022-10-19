<?php


namespace App\FromSky\DomainLayer\Store\Discounts;

use App\Model\Cart;
use App\Model\Discount;
use App\FromSky\DomainLayer\Store\Contracts\DiscountCalculator;

/**
 * Class CouponDiscountCalculator
 * @package App\FromSky\DomainLayer\Store\Discounts
 */
class CouponDiscountCalculator implements DiscountCalculator
{

    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return float
     */
    function process(): float
    {
        return $this->getDiscount();
    }

    /**
     * @return float
     */
    protected function getDiscount(): float
    {
        $this->discount = Discount::getByCode($this->cart->discount_code)->first();
        if (optional($this->discount)->checkDiscount()) {
            return $this->calculateAmount();
        }
        return 0;
    }

    /**
     * @return float
     */
    protected function calculateAmount()
    {
        if ($this->discount->type === Discount::AMOUNT) {
            return $this->DiscountAmount();
        }
        if ($this->discount->type === Discount::PERCENT) {
            return $this->DiscountPercent();
        }
    }

    /**
     * @return mixed
     */
    protected function DiscountAmount()
    {
        return $this->discount->amount;
    }

    /**
     * @return float
     */
    protected function DiscountPercent(): float
    {
        if ($this->discount->amount) {
            $discount_ratio = $this->discount->amount / 100;
            // product cost
            $products_total = $this->cart->getTotalProducts();
            return $products_total * $discount_ratio;
        }
        return 0;
    }
}