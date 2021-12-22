<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
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
            'education' => 'required',
            'work' => 'required',
            'employer' => 'required',
            'about_me' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'height' => 'required',
            'speaks' => 'required',
            'cast' => 'required',
            'smoking' => 'required',
            'drinks' => 'required',
            'food' => 'required',
            'marray_age' => 'required',
            'user_id' => 'required|unique:user_details',
            'address' => 'required',
        ];
    }
}
