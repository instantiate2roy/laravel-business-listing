<?php

namespace Database\Seeders;

use App\Models\NavigationMenu;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class NavigationMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        NavigationMenu::factory()
            ->count(6)
            ->activated()
            ->state(new Sequence(
                ['menu_code' => 'TOP_LEFT_NAV_BAR', 'menu_name' => 'Top left Navigation bar'],
                ['menu_code' => 'TOP_RIGHT_NAV_BAR', 'menu_name' => 'Top Right Navigation bar'],
                ['menu_code' => 'SYS_CONFIG_LEFT_SIDE_BAR', 'menu_name' => 'System Configurations'],
                ['menu_code' => 'USER_CONFIG_LEFT_SIDE_BAR', 'menu_name' => 'User Configurations'],
                ['menu_code' => 'SYS_CONFI_DROPDOWN', 'menu_name' => 'System Configurations drop down'],
                ['menu_code' => 'NAV_CONFIG', 'menu_name' => 'Navigation Configurations'],
            ))
            ->create();
    }
}
