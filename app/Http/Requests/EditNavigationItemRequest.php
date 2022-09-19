<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditNavigationItemRequest extends FormRequest
{
    protected $fieldSizeMaxLimits = [
        'nav_code' => 25,
        'nav_name' => 50,
        'nav_menu' => 25,
        'nav_status' => 25
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
            'nav_name' => 'required|max:' . $this->fieldSizeMaxLimits['nav_name'],
            'nav_menu' => 'required|max:' . $this->fieldSizeMaxLimits['nav_menu'],
            'nav_status' => 'required|max:' . $this->fieldSizeMaxLimits['nav_status'],
        ];
    }

    public function messages()
    {
        return [
            'nav_name.required' => 'The navigation item name should not be empty !',
            'nav_name.max' => 'The navigation item name should not be longer than ' . $this->fieldSizeMaxLimits['nav_name'] . ' characters !',

            'nav_menu.required' => 'The navigation item parent menu should not be empty !',
            'nav_menu.max' => 'The navigation item parent menu should not be longer than ' . $this->fieldSizeMaxLimits['nav_menu'] . ' characters !',

            'nav_status.required' => 'The navigation status should not be empty !',
            'nav_status.max' => 'The navigation status should not be longer than ' . $this->fieldSizeMaxLimits['nav_status'] . ' characters !',
        ];
    }
}
