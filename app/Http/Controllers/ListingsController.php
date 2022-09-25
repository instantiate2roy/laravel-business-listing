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
    public function index(Request $request)
    {
        //
        $navBar  = new stdClass;
        $navBar->right = NavMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        if (UserChecking::hasRole(['SU_ADMIN', 'SU_ADMIN'])) {
            $navBar->left = NavMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');
        }

        $whereClauses = [['biz_status', 'ACTV']];
        if ($request->query('listingSearchParam')) {
            $whereClauses = [['biz_name', 'LIKE', '%' . $request->query('listingSearchParam') . '%'], ['biz_status', 'ACTV']];
        }

        $listings = Business::where($whereClauses)->inRandomOrder()
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);

        $listings->prevSearch = $request->query('listingSearchParam');



        $lastPageName = $this->lastPageName;

        return view('listing.index', compact('listings', 'lastPageName', 'navBar'));
    }
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Business::where([['biz_name', 'LIKE', '%' . $query . '%'], ['biz_status', 'ACTV']])->get();
        return response()->json($filterResult);
    }
}
