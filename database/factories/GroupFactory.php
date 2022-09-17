<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
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
            'group_code' => '',
            'group_name' => '',
            'group_status' => ''
        ];
    }

    public function activated()
    {
        return $this->state(function (array $attributes) {
            return [
                'group_status' => 'ACTV'
            ];
        });
    }
}
