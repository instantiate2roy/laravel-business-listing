<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'biz_code' => '',
            'biz_name' => '',
            'biz_status' => '',
            'biz_image_path' => '',
            'biz_owner' => ''
        ];
    }

    public function defaultImage()
    {
        return $this->state(function () {
            return [
                'biz_code' => '',
                'biz_name' => '',
                'biz_status' => '',
                'biz_image_path' => '/business_listing/default.jpg',
                'biz_owner' => ''
            ];
        });
    }

    public function activated()
    {
        return $this->state(function () {
            return [
                'biz_code' => '',
                'biz_name' => '',
                'biz_status' => 'ACTV',
                'biz_image_path' => '/business_listing/default.jpg',
                'biz_owner' => ''
            ];
        });
    }
}
