<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectCreateRequest extends Request
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
			'name'=>'required',
            'user_id'=>'required',
            'description'=>'required',
            'icon_path'=>'required',
            'client_name'=>'required',
            'value'=>'required|alpha_num',
            'update_schedule'=>'required|alpha_num',
        ];
    }
	public function messages()
	{
		return [
			'name.required'=>'form name is empty.',
			'user_id.required'=>'form project coordinator is empty.',
			'description.required'=>'form description is empty.',
			'icon_path.required'=>'form icon is empty.',
			'client_name.required'=>'form client name is empty.',
			'value.required'=>'form project cost is empty.',
			'value.alpha_num'=>'project cost must a number.',
			'update_schedule.required'=>'form notification schedule is empty.',
			'update_schedule.alpha_num'=>'notification schedule must a number.',
		];
	}
}
