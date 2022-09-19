<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NavigationMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_code' => '',
            'menu_name' => '',
            'menu_status' => ''
        ];
    }

    public function activated()
    {
        return $this->state(function (array $attributes) {
            return ['menu_status' => 'ACTV'];
        });
    }
}
