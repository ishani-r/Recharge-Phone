<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Admin;

class EditAdminRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $value = $request->all();
        return [
            'name' => 'required',
            'email' =>  'required|string|email|max:255|regex:/(.+)@(.+)\.(.+)/i|unique:admins,email,' . $value['id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Name.',
            'email.required' => 'Please Enter Your Email Address.',
        ];
    }
}
