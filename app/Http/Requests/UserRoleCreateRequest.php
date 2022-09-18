<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRoleCreateRequest extends FormRequest
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
            //
            'ur_userid' => 'required',
            'ur_rolecode' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'ur_userid.required' => 'Please select a user !',
            'ur_rolecode.required' => 'Please assign a role to this user !'
        ];
    }
}
