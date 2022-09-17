<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RankFactory extends Factory
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
            'rank_number' => '',
            'rank_name' => '',
            'rank_status' => ''
        ];
    }

    public function activated()
    {
        return $this->state(function (array $attributes) {
            return [
                'rank_status' => 'ACTV'
            ];
        });
    }
}
