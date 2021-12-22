<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'terms_and_conditions' => 'required',
            'privacy_policy' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'terms_and_conditions.required' => 'Enter Teams And Condition !',
            'privacy_policy.required' => 'Enter Privacy Policy !',
        ];
    }
}