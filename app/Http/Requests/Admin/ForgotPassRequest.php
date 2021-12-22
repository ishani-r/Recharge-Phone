<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPassRequest extends FormRequest
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
            'otp' => 'required',
            'password' => 'required|min:8|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ];
    }

    public function messages()
    {
        return [
            'otp.required' => 'Please Enter OTP !',
            'password.required' => 'Please Enter Your Password !',
            'password.regex' => 'Password must be at least 8 characters in length and must contain at least one number, one Upper Case latter, one Lower Case latter !!',
        ];
    }
}
