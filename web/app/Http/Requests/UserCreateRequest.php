<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username',
            'password'  => 'required',
            'name' => 'required',
            'position' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username cannot empty',
            'username.unique' => 'Username is already taken',
            'password.required' => 'Password cannot empty',
            'name.required' => 'Name cannot empty',
            'position.required' => 'Position cannot empty',
        ];
    }
}
