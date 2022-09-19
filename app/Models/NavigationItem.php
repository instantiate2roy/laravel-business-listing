<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NavigationItem extends Model
{
    use HasFactory;
    protected $table = 'navigation_items';
    protected $primaryKey = 'id';
    use SoftDeletes;

    public function navigationMenu()
    {
        return   $this->belongsTo(NavigationMenu::class, 'menu_code', 'nav_menu');
    }

    public function getNavigationMenuAttribute()
    {
        $navigationMenu = NavigationMenu::where('menu_code', $this->nav_menu)->first();
        if ($navigationMenu) {
            $navigationMenuName = $navigationMenu->menu_name;
        } else {
            $navigationMenuName = $this->nav_menu;
        }

        return $navigationMenuName;
    }

    public function getNavigationItemStatusAttribute()
    {

        $lookup = Lookup::where([['lk_key', $this->nav_status], ['lk_scope', 'NAV_MENUS_ITEMS']])
            ->first();
        if ($lookup) {
            $val = $lookup->lk_short_description;
        } else {
            $val = $this->nav_status;
        }

        return $val;
    }
}
