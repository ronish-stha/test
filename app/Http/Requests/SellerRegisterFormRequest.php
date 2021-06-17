<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'first_name' => 'required',
            'last_name' => 'required',
            'store_name' => 'required|unique:seller_details',
            'email' => 'required|unique:users',
            'phone1' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];
    }
}
