<?php

namespace App\Http\Controllers;

use App\CustomClasses\NavMenu;
use App\CustomClasses\UserChecking;
use App\Http\Requests\AddBusinessRequest;
use App\Models\Business;
use Illuminate\Http\Request;
use stdClass;

class BusinessesController extends Controller
{
    protected $paginationPageName = 'groupsPage';
    protected $lastPageName = 'groupsLastPage';
    protected $groupStatusLookups = [];

    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $navBar =  $this->setNavItems();
        $businesses = Business::where([])
            ->orderByDesc('created_at')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);
        $confirmDeleteMsg = 'Are you sure you want to delete this Business?';
        $lastPageName = $this->lastPageName;

        return view('business.index', compact('businesses', 'lastPageName', 'confirmDeleteMsg', 'navBar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $navbar =  $this->setNavItems();

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;

        return view(
            'business.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'navbar'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBusinessRequest $request)
    {
        //
        $business = Business::factory()->activated();
        dd(ini_get('upload_max_filesize'));
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $navbar =  $this->setNavItems();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $navbar =  $this->setNavItems();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function setNavItems()
    {
        $navBar  = new stdClass;
        $navBar->right = NavMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        if (UserChecking::hasRole(['SU_ADMIN', 'SU_ADMIN'])) {
            $navBar->left = NavMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');
        }
        return $navBar;
    }
}
