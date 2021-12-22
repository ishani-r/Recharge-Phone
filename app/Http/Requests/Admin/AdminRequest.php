<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'email' =>  'required|string|email|max:255|regex:/(.+)@(.+)\.(.+)/i|unique:admins',
            'password' => 'required|min:8|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => trans('Please Enter Your Name.'),
            'email.required' => trans('Please Enter Your Email Address.'),
            'password.required' => trans('Please Enter Your Password.'),
            'image.required' => trans('Please Select Your Profile Picture.'),
            'password.regex' => trans('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.')
        ];
    }
}
