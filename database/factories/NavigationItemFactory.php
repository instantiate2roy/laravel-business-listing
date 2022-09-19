<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NavigationItemFactory extends Factory
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
            'nav_code' => '',
            'nav_name' => '',
            'nav_url' => '',
            'nav_menu' => '',
            'nav_status' => '',
        ];
    }

    public function activated()
    {
        return $this->state(function () {
            return ['nav_status' => 'ACTV'];
        });
    }
}
