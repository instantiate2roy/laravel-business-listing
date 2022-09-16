<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    protected $fieldSizeMaxLimits = [
        'group_code' => 25,
        'group_name' => 100,
    ];
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
            //
            'group_code' => 'required|max:' . $this->fieldSizeMaxLimits['group_code'],
            'group_name' => 'required|max:' . $this->fieldSizeMaxLimits['group_name'],
            'group_status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
            'group_code.required' => 'The group code should not be empty !',
            'group_code.max' => 'The group code should not be longer than ' . $this->fieldSizeMaxLimits['group_code'] . ' characters !',
            'group_name.required' => 'The group name should not be empty !',
            'group_name.max' => 'The group name should not be longer than ' . $this->fieldSizeMaxLimits['group_name'] . ' characters !',
            'group_status.required' => 'Please select a group status !',


        ];
    }
}
