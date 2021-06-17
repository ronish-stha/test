<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyFormRequest extends FormRequest
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
            'owner_name' => 'required',
            'address' => 'required',
            'district' => 'required',
            'province' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'business_registration' => 'required|mimes:jpg,png,jpeg|max:2000'
        ];
    }
}
