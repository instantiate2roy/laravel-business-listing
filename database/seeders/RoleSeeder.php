<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::factory()
            ->count(5)
            ->activated()
            ->state(new Sequence(
                [
                    'role_code' => 'SU_ADMIN',
                    'role_name' => 'Super User',
                    'role_rank' => 1000,
                    'role_group' => 'ADMIN',
                ],
                [
                    'role_code' => 'SEC_ADMIN',
                    'role_name' => 'Security Admin',
                    'role_rank' => 800,
                    'role_group' => 'ADMIN'
                ],
                [
                    'role_code' => 'BU_ADMIN',
                    'role_name' => 'Business Admin',
                    'role_rank' => 600,
                    'role_group' => 'ADMIN'
                ],
                [
                    'role_code' => 'USR_SECTION',
                    'role_name' => 'Section Head',
                    'role_rank' => 300,
                    'role_group' => 'USR'
                ],
                [
                    'role_code' => 'USR_NORM',
                    'role_name' => 'User',
                    'role_rank' => 100,
                    'role_group' => 'USR'
                ]
            ))
            ->create();
    }
}
