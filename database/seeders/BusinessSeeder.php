<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Business::factory()->count(1)->defaultImage()->state(new Sequence(
            ['biz_code' => 'TEST_BIZ', 'biz_name' => 'Test business', 'biz_status' => 'ACTV', 'biz_owner' => '1']
        ))->create();
    }
}
