<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserRoleFactory extends Factory
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
            'ur_userid' => '',
            'ur_rolecode' => ''
        ];
    }
}
