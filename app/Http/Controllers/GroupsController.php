<?php

namespace App\Http\Controllers;

use App\CustomClasses\Lookups;
use App\CustomClasses\NavMenu;
use App\CustomClasses\UserChecking;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\Lookup;
use Illuminate\Http\Request;
use stdClass;

class GroupsController extends Controller
{
    protected $paginationPageName = 'groupsPage';
    protected $lastPageName = 'groupsLastPage';
    protected $sidebar, $navBar;
    protected $groupStatusLookups = [];
    function __construct(NavMenu $navMenu, Lookups $lookups)
    {
        $this->middleware('auth');

        $this->sidebar = $navMenu::get('USER_CONFIG_LEFT_SIDE_BAR', 'ACTV', 'GRP_CONFIG');
        $this->navBar  = new stdClass;
        $this->navBar->right = $navMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        $this->navBar->left = $navMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');

        $this->rankStatusLookups = $lookups::getSimple('GROUPS_STATUS');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $groups = Group::where([])
            ->orderByDesc('created_at')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);
        $confirmDeleteMsg = 'Are you sure you want to delete this Group?';
        $lastPageName = $this->lastPageName;
        $sidebar = $this->sidebar;
        $navBar = $this->navBar;
        return view('group.index', compact('groups', 'lastPageName', 'confirmDeleteMsg', 'sidebar', 'navBar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $groupStatusLookups = $this->groupStatusLookups;

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;
        $navBar = $this->navBar;
        return view(
            'group.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'groupStatusLookups',
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
    public function store(GroupRequest $request)
    {
        //
        $group = new group();
        $group->group_code = $request->input('group_code');
        $group->group_name = $request->input('group_name');
        $group->group_status = $request->input('group_status');


        $group->save();

        return redirect('/groups');
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
        $group = Group::find($id);

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;
        $navBar = $this->navBar;
        $groupStatusLookups = $this->groupStatusLookups;

        return view(
            'group.update',
            compact(
                'group',
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'groupStatusLookups',
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
    public function update(GroupRequest $request, $id)
    {
        //
        $lastPage = $request->input($this->lastPageName);

        $group = Group::find($id);
        $group->group_code = $request->input('group_code');
        $group->group_name = $request->input('group_name');
        $group->group_status = $request->input('group_status');

        $saved = $group->save();
        if (!$saved) {
            return redirect("groups/$group->id/edit?$this->lastPageName=$lastPage")->with('error', 'Update Failed !');
        }

        return redirect("groups/$group->id/edit?$this->lastPageName=$lastPage")->with('success', 'Update Successful');
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

        $group = Group::find($id);
        $deleted = $group->delete();
        if (!$deleted) {
            return redirect("/groups?$this->paginationPageNamee=$lastPage")->with('error', 'Delete Failed!');
        }
        return redirect("/groups?$this->paginationPageName=$lastPage")->with('success', 'Delete Successfully');
    }
}
