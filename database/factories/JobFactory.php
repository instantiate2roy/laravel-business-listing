<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
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
            'job_business' => '',
            'job_customer' => '',
            'job_details' => '',
            'job_expiry' => '',
            'job_status' => '',

        ];
    }





    public function  opened()
    {
        return $this->state(function () {
            return [
                'job_business' => '',
                'job_customer' => '',
                'job_details' => '',
                'job_expiry' => '',
                'job_status' => 'NEW'
            ];
        });
    }
}
