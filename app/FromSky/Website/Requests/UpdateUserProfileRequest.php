<?php

namespace App\FromSky\Website\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'max:255'],
            'lastname'  => ['required', 'max:255'],
            'email'     => ['required',
                'max:255',
                'email',
                Rule::unique('users')->ignore(auth_user()->id)],

        ];
    }
}
