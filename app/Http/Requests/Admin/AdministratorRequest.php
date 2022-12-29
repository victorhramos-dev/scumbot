<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorRequest extends FormRequest
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
        if ($this->administrator) {
            return $this->getUpdateRules();
        } else {
            return $this->getCreateRules();
        }

        return [];
    }

    private function getCreateRules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|email|unique:administrators,email',
            'password' => 'required|confirmed',
        ];
    }

    private function getUpdateRules()
    {
        $administratorId = $this->administrator->id;

        return [
            'name'     => 'required',
            'email'    => "required|email|unique:administrators,email,{$administratorId}",
            'password' => 'confirmed',
        ];
    }
}
