<?php

namespace Database\Factories;

use App\Models\Lookup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LookupFactory extends Factory
{

    protected $model = Lookup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lk_key' => '',
            'lk_scope' => '',
            'lk_short_description' => '',
            'lk_full_description' => '',
            'lk_category1' => '',
            'lk_category2' => '',
            'lk_category3' => '',
            'lk_category4' => '',
            'lk_category5' => ''
        ];
    }

    public function testLookup()
    {
        return $this->state(function (array $attributes) {
            return [
                'lk_key' => 'test',
                'lk_scope' => 'TESTING',
                'lk_short_description' => 'Lookup For Tests',
                'lk_full_description' => 'nothing In particular'
            ];
        });
    }

    public function trashed()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => now()

            ];
        });
    }
}
