<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NavigationMenu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'navigation_menus';
    protected $primaryKey = 'id';

    public function navigationItems()
    {
        return  $this->hasMany(NavigationItem::class, 'nav_menu', 'menu_code')->orderBy('nav_name');
    }

    public function getStatusNameAttribute()
    {
        $lookup = Lookup::where([['lk_key', $this->menu_status], ['lk_scope', 'NAV_MENUS']])
            ->first();
        if ($lookup) {
            $val = $lookup->lk_short_description;
        } else {
            $val = $this->menu_status;
        }
        return $val;
    }
}
