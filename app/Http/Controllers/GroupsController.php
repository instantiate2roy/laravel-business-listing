<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\Lookup;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    protected $paginationPageName = 'groupsPage';
    protected $lastPageName = 'groupsLastPage';
    protected $sidebar;
    protected $groupStatusLookups = [];
    function __construct()
    {
        $this->middleware('auth');
        $this->sidebar = (object) array(
            'title' => 'User Management',
            'titleLevel2' => 'Menus',
            'items' => (object) array(
                ['name' => 'Groups', 'url' => '/groups', 'active' => 'active'],
                ['name' => 'Ranks', 'url' => '/ranks', 'active' => ''],
                ['name' => 'Roles', 'url' => '/roles', 'active' => ''],
                ['name' => 'User Roles', 'url' => '/userRoles', 'active' => '']
            )
        );

        $lookups = Lookup::where('lk_scope', 'GROUPS')->get();

        foreach ($lookups as $lookup) {
            $this->groupStatusLookups[$lookup->lk_key] = $lookup->lk_short_description;
        }
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

        return view('group.index', compact('groups', 'lastPageName', 'confirmDeleteMsg', 'sidebar'));
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

        return view(
            'group.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'groupStatusLookups'
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

        $groupStatusLookups = $this->groupStatusLookups;

        return view(
            'group.update',
            compact(
                'group',
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'groupStatusLookups'
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
