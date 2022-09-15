<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LookupRequest extends FormRequest
{
    protected $fieldSizeMaxLimits = [
        'lk_key' => 25,
        'lk_scope' => 25,
        'lk_short_description' => 40,
        'lk_full_description' => 150,
        'lk_category1' => 25,
        'lk_category2' => 25,
        'lk_category3' => 25,
        'lk_category4' => 25,
        'lk_category5' => 25
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
            'lk_key' => 'required|max:' . $this->fieldSizeMaxLimits['lk_key'],
            'lk_scope' => 'required|max:' . $this->fieldSizeMaxLimits['lk_scope'],
            'lk_short_description' => 'required|max:' . $this->fieldSizeMaxLimits['lk_short_description'],
            'lk_full_description' => 'required|max:' . $this->fieldSizeMaxLimits['lk_full_description'],
            'lk_category1' => 'max:' . $this->fieldSizeMaxLimits['lk_category1'],
            'lk_category2' => 'max:' . $this->fieldSizeMaxLimits['lk_category2'],
            'lk_category3' => 'max:' . $this->fieldSizeMaxLimits['lk_category3'],
            'lk_category4' => 'max:' . $this->fieldSizeMaxLimits['lk_category4'],
            'lk_category5' => 'max:' . $this->fieldSizeMaxLimits['lk_category5'],
        ];
    }

    public function messages()
    {
        return [
            //
            'lk_key.required' => 'The Key should not be empty !',
            'lk_key.max' => 'The Key should not be longer than ' . $this->fieldSizeMaxLimits['lk_key'] . ' characters !',
            'lk_scope.required' => 'The Scope should not be empty !',
            'lk_scope.max' => 'The Scope should not be longer than ' . $this->fieldSizeMaxLimits['lk_scope'] . ' characters !',
            'lk_short_description.required' => 'The Short Description should not be empty !',
            'lk_short_description.max' => 'The Short Description should not be longer than ' . $this->fieldSizeMaxLimits['lk_short_description'] . ' characters !',
            'lk_full_description.required' => 'The Full Description should not be empty !',
            'lk_full_description.max' => 'The Full Description should not be longer than ' . $this->fieldSizeMaxLimits['lk_full_description'] . ' characters !',
            'lk_category1.max' => 'Category 1 should not be longer than ' . $this->fieldSizeMaxLimits['lk_category1'] . ' characters !',
            'lk_category2.max' => 'Category 2 should not be longer than ' . $this->fieldSizeMaxLimits['lk_category2'] . ' characters !',
            'lk_category3.max' => 'Category 3 should not be longer than ' . $this->fieldSizeMaxLimits['lk_category3'] . ' characters !',
            'lk_category4.max' => 'Category 4 should not be longer than ' . $this->fieldSizeMaxLimits['lk_category4'] . ' characters !',
            'lk_category5.max' => 'Category 5 should not be longer than ' . $this->fieldSizeMaxLimits['lk_category5'] . ' characters !',

        ];
    }
}
