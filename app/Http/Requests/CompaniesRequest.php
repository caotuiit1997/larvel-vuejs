<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'website' => 'required',
            'avatar' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'address.required' => 'Please enter address',
            'website.required' => 'Please enter website',
            'avatar.required' => 'Please enter avatar',
        ];
    }
}
