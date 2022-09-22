<?php

namespace Database\Seeders;

use App\Models\Lookup;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Lookup::factory()->count(2)->state(new Sequence(
            ['lk_key' => 'ACTV', 'lk_short_description' => 'Active'],
            ['lk_key' => 'INACTV', 'lk_short_description' => 'In Active']
        ))->create(['lk_scope' => 'RANKS_STATUS']);

        Lookup::factory()->count(2)->state(new Sequence(
            ['lk_key' => 'ACTV', 'lk_short_description' => 'Active'],
            ['lk_key' => 'INACTV', 'lk_short_description' => 'In Active']
        ))->create(['lk_scope' => 'ROLES_STATUS']);

        Lookup::factory()->count(2)->state(new Sequence(
            ['lk_key' => 'ACTV', 'lk_short_description' => 'Active'],
            ['lk_key' => 'INACTV', 'lk_short_description' => 'In Active']
        ))->create(['lk_scope' => 'GROUPS_STATUS']);

        Lookup::factory()->count(2)->state(new Sequence(
            ['lk_key' => 'ACTV', 'lk_short_description' => 'Active'],
            ['lk_key' => 'INACTV', 'lk_short_description' => 'In Active']
        ))->create(['lk_scope' => 'NAV_MENUS_STATUS']);

        Lookup::factory()->count(2)->state(new Sequence(
            ['lk_key' => 'ACTV', 'lk_short_description' => 'Active'],
            ['lk_key' => 'INACTV', 'lk_short_description' => 'In Active']
        ))->create(['lk_scope' => 'NAV_MENUS_ITEMS_STATUS']);

        Lookup::factory()->count(2)->state(new Sequence(
            ['lk_key' => 'ACTV', 'lk_short_description' => 'Active'],
            ['lk_key' => 'INACTV', 'lk_short_description' => 'In Active']
        ))->create(['lk_scope' => 'BUSINESS_STATUS']);
    }
}
