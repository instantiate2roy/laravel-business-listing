<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavigationEditMenuRequest extends FormRequest
{
    protected $fieldSizeMaxLimits = [
        'menu_code' => 25,
        'menu_name' => 50
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
            'menu_name' => 'required|max:' . $this->fieldSizeMaxLimits['menu_name'],
        ];
    }

    public function messages()
    {
        return [

            'menu_name.required' => 'The menu name should not be empty !',
            'menu_name.max' => 'The menu name should not be longer than ' . $this->fieldSizeMaxLimits['menu_name'] . ' characters !',
        ];
    }
}
