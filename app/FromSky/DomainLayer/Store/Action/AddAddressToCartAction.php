<?php


namespace App\FromSky\DomainLayer\Store\Action;


use App\Model\Address;

class AddAddressToCartAction
{


    private $cart;
    private $type;
    private $model;

    public function __construct($cart)
    {
        $this->cart = $cart;

    }

    function handle($data, $type = 'shipping')
    {
        $this->type  = $type;
        $this->model = $this->getAddress();

        foreach ($this->model->getFillable() as $field) {
            $request_field = $this->getRequestField($field);
            if ($data->has($request_field)) {
                $this->model->$field = $data->get($request_field);
            }
            $this->model->user_id = $this->cart->user_id;
        }
        $this->model->save();
        return $this->model;
    }

    function getAddress()
    {
        return Address::firstOrCreate(['id' => $this->cart->{$this->type . '_address_id'}]);
    }

    function getRequestField($field)
    {
        return ($this->type == 'shipping') ? $field : $this->type . '_' . $field;
    }
}