<?php

namespace App\Http\Controllers;

use App\CustomClasses\NavMenu;
use App\CustomClasses\UserChecking;
use App\Http\Requests\AddBusinessRequest;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $businesses = Business::where('biz_owner', Auth::user()->id)
            ->orderByDesc('created_at')
            ->paginate($perPage = 12, $columns = ['*'], $pageName = $this->paginationPageName);
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

        $path = $request->file('biz_image_path')->store('business_listing', 'public');
        if (!Storage::disk('public')->exists($path)) {

            return redirect('businesses/create')
                ->with('error', 'Failed to save file to server!')
                ->withInput();
        }

        $business = Business::factory()->activated()->make();

        $business->biz_name = $request->input('biz_name');
        $business->biz_code = $request->input('biz_code');
        $business->biz_owner = Auth::user()->id;
        $business->biz_image_path = $path;


        $created = $business->save();

        if (!$created) {
            return redirect('businesses/create')
                ->with('error', 'Failed create new Business!')
                ->withInput();
        }
        return redirect('/businesses');
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
