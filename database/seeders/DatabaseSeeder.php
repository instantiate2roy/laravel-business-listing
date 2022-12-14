<?php

namespace Database\Seeders;

use App\Models\NavigationMenu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            LookupSeeder::class,
            RankSeeder::class,
            GroupSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
            NavigationMenuSeeder::class,
            NavigationItemSeeder::class,
            BusinessSeeder::class

        ]);
    }
}
