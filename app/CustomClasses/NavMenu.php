<?php

namespace App\CustomClasses;

use App\Models\NavigationItem;
use App\Models\NavigationMenu;
use stdClass;

class NavMenu
{

    /**
     * get nav config
     *
     * @param string $navMenuCode
     * @param string $status
     * @param string|null $active
     * 
     * @return stdClass
     * 
     */
    public static function get(string $navMenuCode, string $status, string $active = null): stdClass
    {
        $sidebarMenu = NavigationMenu::where([['menu_code', $navMenuCode], ['menu_status', $status]])->first();
        $sidebar = new stdClass;
        if ($sidebarMenu) {
            $sidebar->title = $sidebarMenu->menu_name;
            $sidebar->items = [];
            foreach ($sidebarMenu->navigationItems as $item) {
                $item->childElements = self::children($item);
                if ($item->nav_code == $active) {
                    $item->active = 'active';
                }
                array_push($sidebar->items, $item);
            }
        }
        return $sidebar;
    }

    private function children($item)
    {
        return NavigationItem::where('nav_menu', $item->nav_code)->get();
    }

    /**
     * get navigation menus As lookups
     *
     * @param bool $active
     * 
     * @return array
     * 
     */
    public static function menusAslookups(bool $active = true): array
    {
        $activeFlag = 'ACTV';
        $menuLookups = [];

        if (!$active) {
            $activeFlag = 'INACTV';
        }

        $menus = NavigationMenu::where('menu_status',    $activeFlag)->get();

        foreach ($menus as $menu) {
            $menuLookups[$menu->menu_code] = $menu->menu_name;
        }

        return $menuLookups;
    }

    public static function itemsAsLookups()
    {
    }
}
