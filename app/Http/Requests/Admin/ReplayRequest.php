<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReplayRequest extends FormRequest
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
            'subject' => 'required',
            'email' => 'required|string|email|max:255|regex:/(.+)@(.+)\.(.+)/i',
            'message' => 'required',
            'replay' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Please Enter Your Replay.',
            'email.required' => 'Please Enter Your Replay.',
            'message.required' => 'Please Enter Your Replay.',
            'replay.required' => 'Please Enter Your Replay.',
        ];
    }
}
