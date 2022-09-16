<?php

namespace App\Http\Controllers;

use App\Http\Requests\RankRequest;
use App\Models\Lookup;
use App\Models\Rank;
use Illuminate\Http\Request;

class RanksController extends Controller
{
    protected $paginationPageName = 'ranksPage';
    protected $lastPageName = 'ranksLastPage';
    protected $sidebar;
    protected $rankStatusLookups = [];
    function __construct()
    {
        $this->middleware('auth');

        $this->sidebar = (object) array(
            'title' => 'User Management',
            'titleLevel2' => 'Menus',
            'items' => (object) array(
                ['name' => 'Groups', 'url' => '/groups', 'active' => ''],
                ['name' => 'Ranks', 'url' => '/ranks', 'active' => 'active'],
                ['name' => 'Roles', 'url' => '/roles', 'active' => ''],
                ['name' => 'Users', 'url' => '/users', 'active' => ''],

            )
        );

        $lookups = Lookup::where('lk_scope', 'RANKS')->get();

        foreach ($lookups as $lookup) {
            $this->rankStatusLookups[$lookup->lk_key] = $lookup->lk_short_description;
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

        $ranks = Rank::where([])
            ->orderByDesc('created_at')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);
        $confirmDeleteMsg = 'Are you sure you want to delete this Rank?';
        $lastPageName = $this->lastPageName;
        $sidebar = $this->sidebar;

        return view('rank.index', compact('ranks', 'lastPageName', 'confirmDeleteMsg', 'sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //
        $rankStatusLookups = $this->rankStatusLookups;

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        return view(
            'rank.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'rankStatusLookups'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RankRequest $request)
    {
        //
        $rank = new Rank();
        $rank->rank_number = $request->input('rank_number');
        $rank->rank_name = $request->input('rank_name');
        $rank->rank_status = $request->input('rank_status');


        $rank->save();

        return redirect('/ranks');
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
        $rank = Rank::find($id);

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $sidebar = $this->sidebar;

        $rankStatusLookups = $this->rankStatusLookups;

        return view(
            'rank.update',
            compact(
                'rank',
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'sidebar',
                'rankStatusLookups'
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
    public function update(RankRequest $request, $id)
    {
        //

        $lastPage = $request->input($this->lastPageName);

        $rank = Rank::find($id);
        $rank->rank_number = $request->input('rank_number');
        $rank->rank_name = $request->input('rank_name');
        $rank->rank_status = $request->input('rank_status');

        $saved = $rank->save();
        if (!$saved) {
            return redirect("ranks/$rank->id/edit?$this->lastPageName=$lastPage")->with('error', 'Update Failed !');
        }

        return redirect("ranks/$rank->id/edit?$this->lastPageName=$lastPage")->with('success', 'Update Successful');
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

        $rank = Rank::find($id);
        $deleted = $rank->delete();
        if (!$deleted) {
            return redirect("/ranks?$this->paginationPageNamee=$lastPage")->with('error', 'Delete Failed!');
        }
        return redirect("/ranks?$this->paginationPageName=$lastPage")->with('success', 'Delete Successfully');
    }
}
