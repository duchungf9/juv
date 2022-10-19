<?php

namespace App\FromSky\DomainLayer\Store\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class AddressFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'firstname'  => 'required|max:255',
            'lastname'   => 'required|max:255',
            'street'     => 'required',
            'number'     => 'required',
            'zip_code'   => 'required',
            'city'       => 'required',
            'province'   => 'required',
            'phone'      => 'required',
            'country_id' => 'required|numeric',
            'email'      => 'email',

            'billing_firstname'  => ['required_if:shippingAsBilling,1'],
            'billing_lastname'   => ['required_if:shippingAsBilling,1'],
            'billing_street'     => ['required_if:shippingAsBilling,1'],
            'billing_number'     => ['required_if:shippingAsBilling,1'],
            'billing_zip_code'   => ['required_if:shippingAsBilling,1'],
            'billing_city'       => ['required_if:shippingAsBilling,1'],
            'billing_province'   => ['required_if:shippingAsBilling,1'],
            'billing_country_id' => ['required_if:shippingAsBilling,1'],
            'billing_email'      => ['required_if:shippingAsBilling,1'],
            'billing_phone'      => ['required_if:shippingAsBilling,1']
        ];
        return $rules;
    }


}
