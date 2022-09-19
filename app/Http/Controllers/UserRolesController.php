<?php

namespace App\Http\Controllers;

use App\CustomClasses\NavMenu;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRoleCreateRequest;
use App\Http\Requests\UserRoleEditRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    protected $paginationPageName = 'userRolesPage';
    protected $lastPageName = 'userRolesLastPage';
    protected $sidebar;
    protected $userRoleLookups = [];
    protected $usersLookup = [];

    function __construct(NavMenu $navMenu)
    {

        $this->middleware('auth');

        $this->sidebar = $navMenu::get('USER_CONFIG_LEFT_SIDE_BAR', 'ACTV', 'USRROLE_CONFIG');

        $roles = Role::where('role_code', '!=', 'SU_ADMIN')->get();
        foreach ($roles as $role) {
            $this->userRoleLookups[$role->role_code] = $role->role_name;
        }

        $users = User::where('name', '!=', 'roy')->get();
        foreach ($users as $user) {
            $this->usersLookup[$user->id] = $user->name;
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
        $userRoles = UserRole::where('ur_rolecode', '!=', 'SU_ADMIN')
            ->orderByDesc('created_at')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);
        $confirmDeleteMsg = 'Are you sure you want to delete this user role?';
        $lastPageName = $this->lastPageName;
        $sidebar = $this->sidebar;

        return view('userRole.index', compact('userRoles', 'lastPageName', 'confirmDeleteMsg', 'sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $userRoleLookups = $this->userRoleLookups;
        $usersLookup = $this->usersLookup;

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        return view(
            'userRole.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'userRoleLookups',
                'usersLookup'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRoleCreateRequest $request)
    {
        //
        $userRole = new UserRole();
        $userRole->ur_userid = $request->input('ur_userid');
        $userRole->ur_rolecode = $request->input('ur_rolecode');

        $saved = $userRole->save();
        if (!$saved) {
            return redirect('/userRoles')->with('error', 'Role Assignment Failed!');
        }

        return redirect('/userRoles')->with('success', 'Role Assignment Successful!');
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
        $userRole = UserRole::find($id);

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        $userRoleLookups = $this->userRoleLookups;
        $usersLookup = $this->usersLookup;

        return view(
            'userRole.update',
            compact(
                'userRole',
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'userRoleLookups',
                'usersLookup'
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
    public function update(UserRoleEditRequest $request, $id)
    {
        //
        $lastPage = $request->input($this->lastPageName);

        $userRole = UserRole::find($id);
        $userRole->ur_rolecode = $request->input('ur_rolecode');
        $saved = $userRole->save();
        if (!$saved) {
            return redirect("userRoles/$userRole->id/edit?$this->lastPageName=$lastPage")->with('error', 'Update Failed !');
        }

        return redirect("userRoles/$userRole->id/edit?$this->lastPageName=$lastPage")->with('success', 'Update Successful');
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

        $userRole = UserRole::find($id);
        $deleted = $userRole->delete();
        if (!$deleted) {
            return redirect("/userRoles?$this->paginationPageNamee=$lastPage")->with('error', 'Delete Failed!');
        }
        return redirect("/userRoles?$this->paginationPageName=$lastPage")->with('success', 'Delete Successfully');
    }
}
