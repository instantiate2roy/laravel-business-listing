<?php

namespace App\Http\Controllers;

use App\CustomClasses\Lookups;
use App\CustomClasses\NavMenu;
use App\Http\Requests\AddNavigationItemRequest;
use App\Http\Requests\EditNavigationItemRequest;
use App\Models\Lookup;
use App\Models\NavigationItem;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;
use stdClass;

class NavigationItemsController extends Controller
{
    protected $paginationPageName = 'navigationItemsPage';
    protected $lastPageName = 'navigationItemsLastPage';
    protected $sidebar;
    protected $navigationItemStatusLookups = [];
    protected $navigationItemMenuLookups = [];

    function __construct(NavMenu $navMenu, Lookups $lookUps)
    {
        $this->middleware('auth');
        $this->sidebar = $navMenu::get('NAV_CONFIG', 'ACTV', 'NAV_ITEM_CONFIG');
        $this->navigationItemMenuLookups = $navMenu::menusAslookups();
        $this->navigationItemStatusLookups = $lookUps::getSimple('NAV_MENUS_ITEMS');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $navigationItems = NavigationItem::where([])
            ->orderByDesc('created_at')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);
        $confirmDeleteMsg = 'Are you sure you want to delete this Navigation Item?';
        $lastPageName = $this->lastPageName;
        $sidebar = $this->sidebar;

        return view('navigationItem.index', compact('navigationItems', 'lastPageName', 'confirmDeleteMsg', 'sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $navigationItemStatusLookups = $this->navigationItemStatusLookups;
        $navigationItemMenuLookups = $this->navigationItemMenuLookups;
        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        return view(
            'navigationItem.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'navigationItemStatusLookups',
                'navigationItemMenuLookups'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNavigationItemRequest $request)
    {
        //
        $navigationItem = NavigationItem::factory()->make();
        $navigationItem->nav_code = $request->input('nav_code');
        $navigationItem->nav_name = $request->input('nav_name');
        $navigationItem->nav_menu = $request->input('nav_menu');
        $navigationItem->nav_url = $request->input('nav_url');
        $navigationItem->nav_status = $request->input('nav_status');


        $saved = $navigationItem->save();
        if (!$saved) {
            return redirect('/navigationItems')->with('error', 'Failed to create Navigation Item');
        }
        return redirect('/navigationItems')->with('success', 'Navigation Item created successfully');
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
        $navigationItem = NavigationItem::find($id);

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        $navigationItemStatusLookups = $this->navigationItemStatusLookups;
        $navigationItemMenuLookups = $this->navigationItemMenuLookups;
        return view(
            'navigationItem.update',
            compact(
                'navigationItem',
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'navigationItemStatusLookups',
                'navigationItemMenuLookups'
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
    public function update(EditNavigationItemRequest $request, $id)
    {
        //
        $lastPage = $request->input($this->lastPageName);

        $navigationItem = NavigationItem::find($id);
        $navigationItem->nav_name = $request->input('nav_name');
        $navigationItem->nav_menu = $request->input('nav_menu');
        $navigationItem->nav_url = $request->input('nav_url');
        $navigationItem->nav_status = $request->input('nav_status');

        $saved = $navigationItem->save();
        if (!$saved) {
            return redirect("navigationItems/$navigationItem->id/edit?$this->lastPageName=$lastPage")->with('error', 'Update Failed !');
        }

        return redirect("navigationItems/$navigationItem->id/edit?$this->lastPageName=$lastPage")->with('success', 'Update Successful');
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

        $navigationItem = NavigationItem::find($id);
        $deleted = $navigationItem->delete();
        if (!$deleted) {
            return redirect("/navigationItems?$this->paginationPageNamee=$lastPage")->with('error', 'Delete Failed!');
        }
        return redirect("/navigationItems?$this->paginationPageName=$lastPage")->with('success', 'Delete Successfully');
    }
}
