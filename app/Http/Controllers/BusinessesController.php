<?php

namespace App\Http\Controllers;

use App\CustomClasses\Lookups;
use App\CustomClasses\NavMenu;
use App\CustomClasses\UserChecking;
use App\Http\Requests\AddBusinessRequest;
use App\Http\Requests\EditBusinessRequest;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use stdClass;

class BusinessesController extends Controller
{
    protected $paginationPageName = 'groupsPage';
    protected $lastPageName = 'groupsLastPage';
    protected $businessStatusLookups = [];
    protected $storageDisk = 'public';

    function __construct(Lookups $lookups)
    {
        $this->middleware('auth');

        $this->businessStatusLookups = $lookups::getSimple('GROUPS_STATUS');
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

        $path = $request->file('biz_image_path')->store('business_listing', $this->storageDisk);
        if (!Storage::disk($this->storageDisk)->exists($path)) {

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
    public function edit(Request $request, $id)
    {
        //
        $navbar =  $this->setNavItems();
        $business = Business::find($id);

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;
        $businessStatusLookups = $this->businessStatusLookups;

        return view(
            'business.update',
            compact(
                'business',
                'lastPageName',
                'lastPage',
                'paginationPageName',

                'businessStatusLookups',
                'navbar'
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
    public function update(EditBusinessRequest $request, $id)
    {
        //
        $lastPage = $request->input($this->lastPageName);

        $business = Business::find($id);
        
        $authorizedToUpdate = Gate::allows('update', $business);
        if (!$authorizedToUpdate) {
            abort(403, 'Unauthorized Access.');
        }

        if ($request->hasFile('biz_image_path')) {
            $this->purgeFile($business->getOriginal('biz_image_path'));
        }

        $path = $request->file('biz_image_path')->store('business_listing', 'public');
        if (!Storage::disk('public')->exists($path)) {

            return redirect('businesses/create')
                ->with('error', 'Failed to save file to server!')
                ->withInput();
        }

        $business->biz_name = $request->input('biz_name');
        $business->biz_code = $request->input('biz_code');
        $business->biz_image_path = $path;

        $saved = $business->save();

        if (!$saved) {
            return redirect("businesses/$business->id/edit?$this->lastPageName=$lastPage")
                ->with('error', 'Update Failed!')
                ->withInput();
        }

        return redirect("businesses/$business->id/edit?$this->lastPageName=$lastPage")->with('success', 'Update Successful');
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

        $business = Business::find($id);

        $authorizedToDelete = Gate::allows('delete', $business);
        if (!$authorizedToDelete) {
            abort(403, 'Unauthorized Access.');
        }
        
        $deleted = $business->delete();
        if (!$deleted) {
            return redirect("/businesses?$this->paginationPageNamee=$lastPage")->with('error', 'Delete Failed!');
        }
        return redirect("/businesses?$this->paginationPageName=$lastPage")->with('success', 'Delete Successfully');
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

    private function purgeFile($filePath)
    {
        $ok = false;
        if (Storage::disk($this->storageDisk)->exists($filePath)) {
            $ok =  Storage::disk($this->storageDisk)->delete($filePath);
        }
        return $ok;
    }
}
