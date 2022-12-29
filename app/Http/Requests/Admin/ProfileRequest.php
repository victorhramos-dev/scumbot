<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $administratorId = auth()->guard('administrator')->user()->id;

        return [
            'name'     => 'required',
            'email'    => "required|email|unique:administrators,email,{$administratorId}",
            'password' => 'confirmed',
        ];
    }
}
