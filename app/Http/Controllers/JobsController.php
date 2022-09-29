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
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Break_;
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
    public function index(Request $request)
    {
        //
        $navBar =  $this->getNavItems();

        $whereClause1 = [['jobs.job_customer',  Auth()->user()->id], ['lk_scope', 'JOB_STATUS']];
        $whereClause2 = [['businesses.biz_owner',  Auth()->user()->id], ['lk_scope', 'JOB_STATUS']];

        if ($request->query('jobSearchParam')) {
            array_push($whereClause1, ['jobs.job_details', 'LIKE', '%' . $request->query('jobSearchParam') . '%']);
            array_push($whereClause2, ['businesses.biz_name', 'LIKE', '%' . $request->query('jobSearchParam') . '%']);
        }

        $userRoleCaseWhenClause = DB::raw("(CASE WHEN jobs.job_customer = " . Auth()->user()->id . " THEN 'CUSTOMER' ELSE 'OWNER' END) AS user_role");

        $jobs = DB::table('jobs')
            ->join('businesses', 'jobs.job_business', '=', 'businesses.biz_code')
            ->leftJoin('lookups', 'lk_key', '=', 'job_status')
            ->where($whereClause1)
            ->orWhere($whereClause2)
            ->orderByDesc('jobs.created_at')
            ->select(
                'jobs.*',
                'businesses.biz_owner',
                'businesses.biz_name',
                'businesses.biz_image_path',
                'lk_short_description',
                $userRoleCaseWhenClause
            )
            ->paginate($perPage = 5, $columns = ['*'], $pageName = $this->paginationPageName);

        $jobs->prevSearch = $request->query('jobSearchParam');

        $lastPageName = $this->lastPageName;


        return view('job.index', compact('jobs', 'lastPageName', 'navBar'));
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
        $action = '';
        if ($request->input('doAction')) {
            $action = $request->input('doAction');
        }

        switch ($action) {
            case 'start':
                $saved = $this->updateJob($id, 'STARTED');
                break;
            case 'decline':
                $saved = $this->updateJob($id, 'DECLINED');
                break;
            case 'close':
                $saved = $this->updateJob($id, 'CLOSED');
                break;
            case 'complete':
                $saved = $this->updateJob($id, 'COMPLETED');
                break;
            case 'drop':
                $saved = $this->updateJob($id, 'DROPPED');
                break;
            default:
                $saved = true;
                break;
        }
        $lastPage = $request->input($this->lastPageName);
        if (!$saved) {

            return redirect("jobs?$this->lastPageName=$lastPage")->with('error', 'Job Update Failed');
        }
        return redirect("jobs?$this->lastPageName=$lastPage")->with('success', 'Job Updated successfully');
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

    private function updateJob($id, $status)
    {
        $job = Job::find($id);
        $job->job_status = $status;
        return $job->save();
    }
}
