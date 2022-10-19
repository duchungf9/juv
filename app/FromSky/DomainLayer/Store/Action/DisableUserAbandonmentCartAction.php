<?php


namespace App\FromSky\DomainLayer\Store\Action;


use App\Model\User;


/*
|--------------------------------------------------------------------------
|  Mark as Disabled abandoned user Cart
|--------------------------------------------------------------------------
*/

/**
 * Class DisableUserAbandonmentCartAction
 * @package App\FromSky\DomainLayer\Store\Action
 */
class DisableUserAbandonmentCartAction
{
    /**
     * @var User
     */
    private $user;

    public function __construct($user)
    {
        $this->user = $user;

    }

    function execute()
    {
        if (!$this->user) return false;
        return $this->disable();
    }

    /**
     * SET AS DISABLED INACTIVE USER CART
     * @return false|int
     */
    function disable()
    {
        if (!$this->user) return false;
        if ($this->user->carts()->where('status', CART_NEW)->count()) {
            return $this->user->carts()
                ->where('status', CART_NEW)
                ->update(['status' => CART_DISABLED]);
        }
    }
}