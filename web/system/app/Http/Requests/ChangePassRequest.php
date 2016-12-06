<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePassRequest extends Request
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
            'oldpass' => 'required',
            'newpass'  => 'required',
            'renewpass' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'oldpass.required' => 'Old Password cannot empty.',
            'newpass.required' => 'New Password cannot empty.',
            'renewpass.required' => 'Re-New Password cannot empty.',
        ];
    }
}
