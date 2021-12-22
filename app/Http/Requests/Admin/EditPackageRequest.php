<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Premium;

class EditPackageRequest extends FormRequest
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
        $value=$request->all();
        return [
            'name' => 'required|unique:premia,name,'.$value['id'],
            'six_months' => 'required',
            'three_months' => 'required',
            'one_months' => 'required',
            'try_days' => 'required',
            'save' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Enter Package Name.',
            'name.unique' => 'Package Name Alredy Exists.',
            'six_months.required' => 'Enter six Months Package Price.',
            'three_months.required' => 'Enter three Months Package Price.',
            'one_months.required' => 'Enter one Months Package Price.',
            'try_days.required' => 'Enter day for free trial.',
            'save.required' => 'Enter Persantage for save many.',
        ];
    }
}
