<?php

namespace App\Http\Controllers;

use App\CustomClasses\Lookups;
use App\CustomClasses\NavMenu;
use App\Http\Requests\NavigationAddMenuRequest;
use App\Http\Requests\NavigationEditMenuRequest;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;
use stdClass;

class NavigationMenusController extends Controller
{
    protected $paginationPageName = 'navigationMenusPage';
    protected $lastPageName = 'navigationMenusLastPage';
    protected $sidebar, $navBar;
    protected $navigationMenuStatusLookups = [];

    function __construct(NavMenu $navMenu, Lookups $lookUps)
    {
        $this->middleware('auth');

        $this->sidebar = $navMenu::get('NAV_CONFIG', 'ACTV', 'NAV_MENU_CONFIG');
        $this->navBar  = new stdClass;
        $this->navBar->right = $navMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        $this->navBar->left = $navMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');

        $this->navigationMenuStatusLookups = $lookUps::getSimple('NAV_MENUS');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $navigationMenus = NavigationMenu::where([])
            ->orderByDesc('created_at')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);
        $confirmDeleteMsg = 'Are you sure you want to delete this Navigation Menu?';
        $lastPageName = $this->lastPageName;
        $sidebar = $this->sidebar;
        $navBar = $this->navBar;
        return view('navigationMenu.index', compact('navigationMenus', 'lastPageName', 'confirmDeleteMsg', 'sidebar', 'navBar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $navigationMenuStatusLookups = $this->navigationMenuStatusLookups;

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;
        $navBar = $this->navBar;
        return view(
            'navigationMenu.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'navigationMenuStatusLookups',
                'navBar'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavigationAddMenuRequest $request)
    {
        //
        $navigationMenu = NavigationMenu::factory()->make();
        $navigationMenu->menu_code = $request->input('menu_code');
        $navigationMenu->menu_name = $request->input('menu_name');
        $navigationMenu->menu_status = $request->input('menu_status');


        $saved = $navigationMenu->save();
        if (!$saved) {
            return redirect('/navigationMenus')->with('error', 'Failed to create Navigation Menu');
        }
        return redirect('/navigationMenus')->with('success', 'Navigation Menu created successfully');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $navigationMenu = NavigationMenu::find($id);

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;
        $navBar = $this->navBar;
        $navigationMenuStatusLookups = $this->navigationMenuStatusLookups;

        return view(
            'navigationMenu.update',
            compact(
                'navigationMenu',
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'navigationMenuStatusLookups',
                'navBar'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NavigationEditMenuRequest $request, $id)
    {
        //

        $lastPage = $request->input($this->lastPageName);

        $navigationMenu = NavigationMenu::find($id);
        $navigationMenu->menu_name = $request->input('menu_name');
        $navigationMenu->menu_status = $request->input('menu_status');

        $saved = $navigationMenu->save();
        if (!$saved) {
            return redirect("navigationMenus/$navigationMenu->id/edit?$this->lastPageName=$lastPage")->with('error', 'Update Failed !');
        }

        return redirect("navigationMenus/$navigationMenu->id/edit?$this->lastPageName=$lastPage")->with('success', 'Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $lastPage = $request->input($this->lastPageName);

        $navigationMenu = NavigationMenu::find($id);
        $deleted = $navigationMenu->delete();
        if (!$deleted) {
            return redirect("/navigationMenus?$this->paginationPageNamee=$lastPage")->with('error', 'Delete Failed!');
        }
        return redirect("/navigationMenus?$this->paginationPageName=$lastPage")->with('success', 'Delete Successfully');
    }
}
