<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Group::Factory()
            ->count(2)
            ->activated()
            ->state(new Sequence(
                ['group_code' => 'ADMIN', 'group_name' => 'Administrator'],
                ['group_code' => 'USR', 'group_name' => 'User']
            ))
            ->create();
    }
}
