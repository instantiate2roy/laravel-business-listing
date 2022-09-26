<?php

namespace App\Http\Controllers;

use App\CustomClasses\Lookups;
use App\CustomClasses\NavMenu;
use App\CustomClasses\UserChecking;
use App\Http\Requests\JobRequest;
use App\Models\Business;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class JobsController extends Controller
{
    protected $paginationPageName = 'jobsPage';
    protected $lastPageName = 'jobsLastPage';
    protected $jobsStatusLookups = [];

    function __construct(Lookups $lookups)
    {
        $this->middleware('auth');
        $this->jobsStatusLookups = $lookups::getSimple('JOB_STATUS');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $navbar =  $this->getNavItems();
        $business = Business::where('biz_code', $request->query('b'))->first();

        $lastPageName = $this->lastPageName;
        $lastPage = $request->query($this->lastPageName);
        $paginationPageName = $this->paginationPageName;

        return view(
            'job.create',
            compact(
                'lastPageName',
                'lastPage',
                'paginationPageName',
                'navbar',
                'business'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        //

        $job = Job::factory()->opened()->make();
        $job->job_details = $request->input('job_details');
        $job->job_expiry = $request->input('job_expiry');
        $job->job_customer = Auth()->user()->id;
        $job->job_business = $request->input('job_business');
        $created = $job->save();

        if (!$created) {
            return redirect('/jobs/create')
                ->with('error', 'Failed create new Business!')
                ->withInput();
        }
        return redirect('/jobs')->with('successs', 'Job Created!');
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
    public function edit($id)
    {
        //
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


    private function getNavItems()
    {
        $navBar  = new stdClass;
        $navBar->right = NavMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        if (UserChecking::hasRole(['SU_ADMIN', 'SU_ADMIN'])) {
            $navBar->left = NavMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');
        }
        return $navBar;
    }
}
