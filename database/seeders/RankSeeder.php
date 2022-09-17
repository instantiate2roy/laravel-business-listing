<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Rank::factory()->count(2)
            ->activated()
            ->state(
                new Sequence(
                    ['rank_number' => 1000, 'rank_name' => 'Super Rank'],
                    ['rank_number' => 100, 'rank_name' => 'lowest Rank']
                )
            )->create();
    }
}
