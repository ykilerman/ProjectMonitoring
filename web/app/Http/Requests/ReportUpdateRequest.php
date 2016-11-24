<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportUpdateRequest extends Request
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
            'highlight' => 'required',
            'project_id' => 'required',
            'activity' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'highlight.required' => 'Highlight is empty.',
            'project_id' => 'Error Authentication.',
            'activity.required' => 'Activity is empty.',
        ];
    }
}
