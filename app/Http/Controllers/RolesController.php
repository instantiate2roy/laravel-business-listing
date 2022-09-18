<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Models\Lookup;
use App\Models\Role;
use App\Models\Rank;
use App\Models\Group;

class RolesController extends Controller
{

    protected $paginationPageName = 'rolesPage';
    protected $lastPageName = 'rolesLastPage';
    protected $sidebar;
    protected $roleStatusLookups = [];
    protected $roleGroupLookups = [];
    protected $roleRankLookups = [];

    function  __construct()
    {
        $this->middleware('auth');

        $this->sidebar = (object) array(
            'title' => 'User Management',
            'titleLevel2' => 'Menus',
            'items' => (object) array(
                ['name' => 'Groups', 'url' => '/groups', 'active' => ''],
                ['name' => 'Ranks', 'url' => '/ranks', 'active' => ''],
                ['name' => 'Roles', 'url' => '/roles', 'active' => 'active'],
                ['name' => 'Users', 'url' => '/userRoles', 'active' => ''],

            )
        );

        $ranks = Rank::where('rank_status', 'ACTV')->get();

        foreach ($ranks as $rank) {
            $this->roleRankLookups[$rank->rank_number] = $rank->rank_name;
        }

        $groups = Group::where('group_status', 'ACTV')->get();

        foreach ($groups as $group) {
            $this->roleGroupLookups[$group->group_code] = $group->group_name;
        }

        $statuses = Lookup::where('lk_scope', 'RANKS')->get();

        foreach ($statuses as $status) {
            $this->roleStatusLookups[$status->lk_key] = $status->lk_short_description;
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
        $roles = Role::where([])
            ->orderByDesc('created_at')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);
        $confirmDeleteMsg = 'Are you sure you want to delete this Role?';
        $lastPageName = $this->lastPageName;
        $sidebar = $this->sidebar;

        return view('role.index', compact('roles', 'lastPageName', 'confirmDeleteMsg', 'sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $roleStatusLookups = $this->roleStatusLookups;
        $roleRankLookups = $this->roleRankLookups;
        $roleGroupLookups = $this->roleGroupLookups;

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        return view(
            'role.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'roleStatusLookups',
                'roleRankLookups',
                'roleGroupLookups'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        //
        $role = new Role();
        $role->role_code = $request->input('role_code');
        $role->role_name = $request->input('role_name');
        $role->role_rank = $request->input('role_rank');
        $role->role_group = $request->input('role_group');
        $role->role_status = $request->input('role_status');

        $role->save();

        return redirect('/roles');
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
        $role = Role::find($id);

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        $roleStatusLookups = $this->roleStatusLookups;
        $roleRankLookups = $this->roleRankLookups;
        $roleGroupLookups = $this->roleGroupLookups;
        return view(
            'role.update',
            compact(
                'role',
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'roleStatusLookups',
                'roleRankLookups',
                'roleGroupLookups'
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
    public function update(RoleRequest $request, $id)
    {
        //

        $lastPage = $request->input($this->lastPageName);

        $role = Role::find($id);
        $role->role_code = $request->input('role_code');
        $role->role_name = $request->input('role_name');
        $role->role_rank = $request->input('role_rank');
        $role->role_group = $request->input('role_group');
        $role->role_status = $request->input('ranrole_statusk_status');

        $saved = $role->save();
        if (!$saved) {
            return redirect("roles/$role->id/edit?$this->lastPageName=$lastPage")->with('error', 'Update Failed !');
        }

        return redirect("roles/$role->id/edit?$this->lastPageName=$lastPage")->with('success', 'Update Successful');
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

        $role = Role::find($id);
        $deleted = $role->delete();
        if (!$deleted) {
            return redirect("/roles?$this->paginationPageNamee=$lastPage")->with('error', 'Delete Failed!');
        }
        return redirect("/roles?$this->paginationPageName=$lastPage")->with('success', 'Delete Successfully');
    }
}
