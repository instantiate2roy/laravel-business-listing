<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RankRequest extends FormRequest
{

    protected $fieldSizeMaxLimits = [
        'rank_number' => 25,
        'rank_name' => 100
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
            'rank_number' => 'required|max:' . $this->fieldSizeMaxLimits['rank_number'],
            'rank_name' => 'required|max:' . $this->fieldSizeMaxLimits['rank_name'],
            'rank_status' => 'required',
        ];
    }

    public function messages()
    {

        return [
            //
            'rank_name.required' => 'The rank name should not be empty !',
            'rank_name.max' => 'The rank name should not be longer than ' . $this->fieldSizeMaxLimits['rank_name'] . ' characters !',
            'rank_number.required' => 'The rank number should not be empty !',
            'rank_number.max' => 'The rank number should not be longer than ' . $this->fieldSizeMaxLimits['rank_number'] . ' characters !',
            'rank_status.required' => 'Please select a rank status !',


        ];
    }
}
