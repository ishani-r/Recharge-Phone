<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
            'email' =>  'required|string|email|max:255|regex:/(.+)@(.+)\.(.+)/i|unique:users',
            'mobile' => 'required|max:10|min:10',
            'gender' => 'required',
            'dob' => 'required',
            'image' => 'required|mimes:jpg,bmp,png',
            'password' => 'required|min:8|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Name.',
            'email.required' => 'Please Enter Your Email Address.',
            'mobile.required' => 'Please Enter Your Mobile Number.',
            'gender.required' => 'Please Enter Your Gender.',
            'dob.required' => 'Please Enter Your Birth Date.',
            'image.required' => 'Please Select Your Profile Picture.',
        ];
    }
}
