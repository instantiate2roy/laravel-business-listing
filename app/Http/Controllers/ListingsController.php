<?php

namespace App\Http\Controllers;

use App\CustomClasses\NavMenu;
use App\CustomClasses\UserChecking;
use App\Models\Business;
use Illuminate\Http\Request;
use stdClass;

class ListingsController extends Controller
{
    protected $paginationPageName = 'listingsPage';
    protected $lastPageName = 'listingsLastPage';
    //
    public function index()
    {
        //
        $navBar  = new stdClass;
        $navBar->right = NavMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        if (UserChecking::hasRole(['SU_ADMIN', 'SU_ADMIN'])) {
            $navBar->left = NavMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');
        }

        $listings = Business::where('biz_status', 'ACTV')
            ->inRandomOrder()
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);

        $lastPageName = $this->lastPageName;

        return view('listing.index', compact('listings', 'lastPageName', 'navBar'));
    }
}
