<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
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
            'role_code' => '',
            'role_name' => '',
            'role_rank' => '',
            'role_group' => '',
            'role_status' => ''
        ];
    }

    public function activated()
    {
        return $this->state(function (array $attributes) {
            return ['role_status' => 'ACTV'];
        });
    }
}
