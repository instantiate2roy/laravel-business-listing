<?php

namespace Database\Seeders;

use App\Models\NavigationItem;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class NavigationItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        NavigationItem::factory()
            ->count(14)
            ->activated()
            ->state(new Sequence(
                [
                    'nav_code' => 'BUS',
                    'nav_name' => 'Businesses',
                    'nav_url' => '/businesses',
                    'nav_menu' => 'TOP_LEFT_NAV_BAR',
                ],
                [
                    'nav_code' => 'LIST',
                    'nav_name' => 'Listings',
                    'nav_url' => '#',
                    'nav_menu' => 'TOP_LEFT_NAV_BAR',
                ],
                [
                    'nav_code' => 'JB',
                    'nav_name' => 'Jobs',
                    'nav_url' => '#',
                    'nav_menu' => 'TOP_LEFT_NAV_BAR',
                ],

                [
                    'nav_code' => 'SYS_CONF',
                    'nav_name' => 'System Configurations',
                    'nav_url' => '',
                    'nav_fa_fa_icon' => 'fa fa-cogs',
                    'nav_menu' => 'TOP_RIGHT_NAV_BAR',
                ],
                [
                    'nav_code' => 'CONFIG_SETUP',
                    'nav_name' => 'Configuration Setup',
                    'nav_url' => '/configuration',
                    'nav_fa_fa_icon' => 'fa fa-wrench',
                    'nav_menu' => 'SYS_CONF',
                ],

                [
                    'nav_code' => 'USER_MAN',
                    'nav_name' => 'User Management',
                    'nav_url' => '/userManagement',
                    'nav_fa_fa_icon' => 'fa fa-users',
                    'nav_menu' => 'SYS_CONF',
                ],
                [
                    'nav_code' => 'LK_UP',
                    'nav_name' => 'Lookup Management',
                    'nav_url' => '/lookups',
                    'nav_menu' => 'SYS_CONFIG_LEFT_SIDE_BAR',
                ],
                [
                    'nav_code' => 'NAV_CONFIG',
                    'nav_name' => 'Navigation Configurations',
                    'nav_url' => '/navigationMenus',
                    'nav_menu' => 'SYS_CONFIG_LEFT_SIDE_BAR',
                ],
                [
                    'nav_code' => 'GRP_CONFIG',
                    'nav_name' => 'Groups',
                    'nav_url' => '/groups',
                    'nav_menu' => 'USER_CONFIG_LEFT_SIDE_BAR',
                ],
                [
                    'nav_code' => 'ROLE_CONFIG',
                    'nav_name' => 'Roles',
                    'nav_url' => '/roles',
                    'nav_menu' => 'USER_CONFIG_LEFT_SIDE_BAR',
                ],
                [
                    'nav_code' => 'USRROLE_CONFIG',
                    'nav_name' => 'User Roles',
                    'nav_url' => '/userRoles',
                    'nav_menu' => 'USER_CONFIG_LEFT_SIDE_BAR',
                ],
                [
                    'nav_code' => 'RNK_CONFIG',
                    'nav_name' => 'Ranks',
                    'nav_url' => '/ranks',
                    'nav_menu' => 'USER_CONFIG_LEFT_SIDE_BAR',
                ],
                [
                    'nav_code' => 'NAV_MENU_CONFIG',
                    'nav_name' => 'Navigation Menus',
                    'nav_url' => '/navigationMenus',
                    'nav_menu' => 'NAV_CONFIG',
                ],
                [
                    'nav_code' => 'NAV_ITEM_CONFIG',
                    'nav_name' => 'Navigation Items',
                    'nav_url' => '/navigationItems',
                    'nav_menu' => 'NAV_CONFIG',
                ],



            ))
            ->create();
    }
}
