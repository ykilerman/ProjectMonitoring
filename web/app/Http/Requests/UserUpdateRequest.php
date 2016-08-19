<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Input;

class UserUpdateRequest extends Request
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
            'username' => 'required|unique:users,username,'.Input::get('id'),
            'name' => 'required',
            'position' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username cannot empty.',
            'username.unique' => 'Username is already taken.',
            'name.required' => 'Name cannot empty.',
            'position.required' => 'Position cannot empty.',
        ];
    }
}
