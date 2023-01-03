<?php

namespace App\Http\Requests\Admin\Drone;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
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
        if ($this->drone) {
            return $this->getUpdateRules();
        }

        return $this->getCreateRules();
    }

    private function getCreateRules()
    {
        $rules = [
            'name'     => ['required'],
            'hwid'     => ['required'],
            'steam_id' => ['required'],
        ];

        return $rules;
    }

    private function getUpdateRules()
    {
        $rules = [
            'name'     => ['required'],
            'steam_id' => ['required'],
        ];

        return $rules;
    }
}
