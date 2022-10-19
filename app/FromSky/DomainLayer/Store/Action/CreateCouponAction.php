<?php


namespace App\FromSky\DomainLayer\Store\Action;


use App\Model\Discount;
use App\FromSky\Tools\CodeGeneratorHelper;

/**
 * Class CreateCouponAction
 * @package App\FromSky\DomainLayer\Store\Action
 */
class CreateCouponAction
{
    protected int $length = 8;
    protected string $discount_type;
    protected int $discount_amount;
    protected int $number_of_use = 1;
    protected string $coupon_code;
    protected array $attributes = [];

    /**
     * CreateCouponAction constructor.
     * @param $discount_type
     * @param $discount_amount
     */
    public function __construct($discount_type, $discount_amount)
    {

        $this->discount_type   = $discount_type;
        $this->discount_amount = $discount_amount;
    }

    /**
     * @return mixed
     */
    function execute()
    {
        return $this->createCoupon();
    }

    /**
     * @return mixed
     */
    function createCoupon()
    {
        $this->coupon_code = $this->generateCode();
        $this->attributes  = [
            'code'      => $this->coupon_code,
            'amount'    => $this->discount_amount,
            'uses'      => $this->number_of_use,
            'type'      => $this->discount_type,
            'is_active' => 1,
        ];
        $discount          = new Discount();
        return tap($discount->newModelInstance($this->attributes), fn($instance) => $instance->save())->code;

    }

    /**
     * @param $number_of_use
     * @return $this
     */
    function setNumberOfUse($number_of_use): CreateCouponAction
    {
        $this->number_of_use = $number_of_use;
        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    function setCouponLength($length): CreateCouponAction
    {
        $this->length = $length;
        return $this;
    }

    /**
     * generate an unique coupon code
     */
    function generateCode(): string
    {
        $options = ['model'  => 'Discount',
                    'field'  => 'code',
                    'length' => $this->length,
                    'type'   => 'alpha_num_uppercase',
        ];
        return (new CodeGeneratorHelper())->handleGenerator($options);
    }
}