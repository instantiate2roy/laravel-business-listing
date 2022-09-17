<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    protected $fieldSizeMaxLimits = [
        'role_code' => 25,
        'role_name' => 100,
        'role_rank' => 25,
        'role_group' => 25,
        'role_status' => 25,
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
            'role_code' => 'required|max:' . $this->fieldSizeMaxLimits['role_code'],
            'role_name' => 'required|max:' . $this->fieldSizeMaxLimits['role_name'],
            'role_rank' => 'required|max:' . $this->fieldSizeMaxLimits['role_rank'],
            'role_group' => 'required|max:' . $this->fieldSizeMaxLimits['role_group'],
            'role_status' => 'required|max:' . $this->fieldSizeMaxLimits['role_status'],
        ];
    }

    /**
     * error messages when validation fails
     *
     * @return array
     * 
     */
    public function messages()
    {
        return [
            //
            'role_code.required' => 'The role code should not be empty !',
            'role_code.max' => 'The role code should not be longer than ' . $this->fieldSizeMaxLimits['role_code'] . ' characters !',

            'role_name.required' => 'The role name should not be empty !',
            'role_name.max' => 'The role name should not be longer than ' . $this->fieldSizeMaxLimits['role_name'] . ' characters !',

            'role_rank.required' => 'The role rank should not be empty !',
            'role_rank.max' => 'The role rank should not be longer than ' . $this->fieldSizeMaxLimits['role_rank'] . ' characters !',

            'role_group.required' => 'The role group should not be empty !',
            'role_group.max' => 'The role group should not be longer than ' . $this->fieldSizeMaxLimits['role_group'] . ' characters !',

            'role_status.required' => 'The role status should not be empty !',
            'role_status.max' => 'The role status should not be longer than ' . $this->fieldSizeMaxLimits['role_status'] . ' characters !'

        ];
    }
}
