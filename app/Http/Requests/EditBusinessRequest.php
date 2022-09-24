<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBusinessRequest extends FormRequest
{
    protected $fieldSizeMaxLimits = [
        'biz_code' => 25,
        'biz_name' => 100,
        'biz_image_path' => 2048
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
            'biz_code' => 'required|max:' . $this->fieldSizeMaxLimits['biz_code'],
            'biz_name' => 'required|max:' . $this->fieldSizeMaxLimits['biz_name'],
            'biz_image_path' => 'file|max:2048|mimes:png,jpg'

        ];
    }
    public function messages()
    {
        return [
            //
            'biz_code.required' => 'The Business code should not be empty !',
            'biz_code.max' => 'The Business code should not be longer than ' . $this->fieldSizeMaxLimits['biz_code'] . ' characters !',
            'biz_name.required' => 'The Business name should not be empty !',
            'biz_name.max' => 'The group Business should not be longer than ' . $this->fieldSizeMaxLimits['biz_name'] . ' characters !',
            'biz_image_path.required' => 'The Business display Image should not be empty !',
            'biz_image_path.mimes' => 'The Business display Image should be of type png or jpg!',
            'biz_image_path.max' => 'The Business display Image should not be bigger than 2Mbs !',



        ];
    }
}
