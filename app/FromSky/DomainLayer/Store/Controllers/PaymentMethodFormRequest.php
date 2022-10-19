<?php

namespace App\FromSky\DomainLayer\Store\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class PaymentMethodFormRequest extends FormRequest
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
            'payment_method_id'  => ['required'],
            'shipping_method_id' => ['sometimes', 'required'],
        ];
        return $rules;
    }
}


