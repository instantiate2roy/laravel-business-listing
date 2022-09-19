<?php

namespace App\Http\Controllers;

use App\CustomClasses\NavMenu;
use App\Http\Requests\LookupRequest;
use App\Models\Lookup;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Http\Request;
use stdClass;

class LookupsController extends Controller
{
    protected $paginationPageName = 'lookupsPage';
    protected $lastPageName = 'lookupsLastPage';
    protected $sidebar;

    function __construct(NavMenu $navMenu)
    {
        $this->middleware('auth');
        $this->sidebar = NavMenu::get('SYS_CONFIG_LEFT_SIDE_BAR', 'ACTV', 'LK_UP');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lookups = Lookup::where([])
            ->orderByDesc('created_at')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);
        $confirmDeleteMsg = 'Are you sure you want to delete this lookup?';
        $lastPageName = $this->lastPageName;
        $sidebar = $this->sidebar;

        return view('lookup.index', compact('lookups', 'lastPageName', 'confirmDeleteMsg', 'sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        return view('lookup.create', compact('lastPageName', 'lastPage', 'paginationPageName', 'sidebar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LookupRequest $request)
    {
        //
        $lookup = Lookup::factory()->make();

        $lookup->lk_key = $request->input('lk_key');
        $lookup->lk_scope = $request->input('lk_scope');
        $lookup->lk_short_description = $request->input('lk_short_description');
        $lookup->lk_full_description = $request->input('lk_full_description');
        $lookup->lk_category1 = $request->input('lk_category1');
        $lookup->lk_category2 = $request->input('lk_category2');
        $lookup->lk_category3 = $request->input('lk_category3');
        $lookup->lk_category4 = $request->input('lk_category4');
        $lookup->lk_category5 = $request->input('lk_category5');

        $lookup->save();

        return redirect('/lookups');
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
        $lookup = Lookup::find($id);
        $sidebar = $this->sidebar;
        return view('lookup.show', compact('lookup', 'sidebar'));
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
        $lookup = Lookup::find($id);

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;
        return view('lookup.update', compact('lookup', 'lastPageName', 'lastPage', 'paginationPageName', 'sidebar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LookupRequest $request, $id)
    {
        //

        $lookup = Lookup::find($id);
        $lookup->lk_key = $request->input('lk_key');
        $lookup->lk_scope = $request->input('lk_scope');
        $lookup->lk_short_description = $request->input('lk_short_description');
        $lookup->lk_full_description = $request->input('lk_full_description');
        $lookup->lk_category1 = $request->input('lk_category1');
        $lookup->lk_category2 = $request->input('lk_category2');
        $lookup->lk_category3 = $request->input('lk_category3');
        $lookup->lk_category4 = $request->input('lk_category4');
        $lookup->lk_category5 = $request->input('lk_category5');
        $saved = $lookup->save();

        $lastPage = $request->input($this->lastPageName);

        if (!$saved) {

            return redirect("lookups/$lookup->id/edit?$this->lastPageName=$lastPage")->with('error', 'Update Failed !');
        }

        return redirect("lookups/$lookup->id/edit?$this->lastPageName=$lastPage")->with('success', 'Update Successful');
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

        $lookup = Lookup::find($id);
        $deleted = $lookup->delete();
        if (!$deleted) {
            return redirect("/lookups?$this->paginationPageNamee=$lastPage")->with('error', 'Delete Failed!');
        }
        return redirect("/lookups?$this->paginationPageName=$lastPage")->with('success', 'Deleted Successfully');
    }
}
