<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserRole::factory()->create(['ur_userid' => '1', 'ur_rolecode' => 'SU_ADMIN']);
    }
}
