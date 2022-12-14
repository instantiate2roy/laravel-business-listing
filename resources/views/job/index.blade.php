@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/jobsScreen.css') }}" rel="stylesheet">
        <div class="container">

            <div class='card'>
                <div class="card-header">
                    <div class="jobsCardSearch">
                        <input type="text" placeholder="Search.." value='{{ $jobs->prevSearch }}' name="search">
                        <button class="btn btn-secondary" id='searchBtn'><i class="fa fa-search"></i></button>
                    </div>
                    <div class="jobCardTitle">Jobs</div>
                </div>
                <div class="card-body">
                    @if ($jobs->count() > 0)
                        {{ $jobs->links() }}
                        <br>
                        <hr>

                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col"></th>
                                    <th scope="col">Business Details</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($jobs as $job)
                                    <tr class="inner-box">

                                        <td width="25%">
                                            <div class="event-img">
                                                <img src="/storage/{{ $job->biz_image_path }}" alt="" width="200"
                                                    height="200" />
                                            </div>
                                        </td>
                                        <td width="60%">
                                            <div class="event-wrap">
                                                <h2><strong><u>{{ $job->biz_name }}</strong></u> (
                                                    {{ $job->lk_short_description }} )</h2>
                                                <br>
                                                <div class="meta">
                                                    <strong>Details:</strong>
                                                    <p>{!! $job->job_details !!}</p>
                                                    <br>
                                                    <div class="organizers">
                                                        <p>expires at: {!! $job->job_expiry !!}</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                        <td width="15%">
                                            <div class="primary-btn">
                                                @if ($job->user_role == 'OWNER')
                                                    @if ($job->job_status == 'OPEN')
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\JobsController@update', $job->id],
                                                            'method' => 'PUT',
                                                        ]) !!}
                                                        {{ Form::hidden($lastPageName, $jobs->currentPage()) }}
                                                        {{ Form::hidden('doAction', 'start') }}
                                                        {!! Form::submit('Start', ['class' => 'btn btn-primary jobListActionBtn']) !!}
                                                        {!! Form::close() !!}


                                                        <br>
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\JobsController@update', $job->id],
                                                            'method' => 'PUT',
                                                        ]) !!}
                                                        {{ Form::hidden($lastPageName, $jobs->currentPage()) }}
                                                        {{ Form::hidden('doAction', 'decline') }}
                                                        {!! Form::submit('Decline', ['class' => 'btn btn-danger jobListActionBtn']) !!}
                                                        {!! Form::close() !!}
                                                        <br>
                                                    @endif
                                                    @if ($job->job_status == 'STARTED')
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\JobsController@update', $job->id],
                                                            'method' => 'PUT',
                                                        ]) !!}
                                                        {{ Form::hidden($lastPageName, $jobs->currentPage()) }}
                                                        {{ Form::hidden('doAction', 'complete') }}
                                                        {!! Form::submit('Complete', ['class' => 'btn btn-success jobListActionBtn']) !!}
                                                        {!! Form::close() !!}
                                                        <br>
                                                        
                                                    @endif
                                                @else
                                                    @if ($job->job_status == 'OPEN')
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\JobsController@update', $job->id],
                                                            'method' => 'PUT',
                                                        ]) !!}
                                                        {{ Form::hidden($lastPageName, $jobs->currentPage()) }}
                                                        {{ Form::hidden('doAction', 'drop') }}
                                                        {!! Form::submit('Drop', ['class' => 'btn btn-danger jobListActionBtn']) !!}
                                                        {!! Form::close() !!}
                                                        <br>
                                                    @endif

                                                    @if ($job->job_status == 'COMPLETED' || $job->job_status == 'DECLINED' || $job->job_status == 'DROPPED')
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\JobsController@update', $job->id],
                                                            'method' => 'PUT',
                                                        ]) !!}
                                                        {{ Form::hidden($lastPageName, $jobs->currentPage()) }}
                                                        {{ Form::hidden('doAction', 'close') }}
                                                        {!! Form::submit('Close', ['class' => 'btn btn-success jobListActionBtn']) !!}
                                                        {!! Form::close() !!}
                                                        <br>
                                                    @endif

                                                    @if ($job->job_status == 'STARTED')
                                                        <p> In Progress ....</p>
                                                        <br>
                                                    @endif
                                                @endif
                                                @if ($job->job_status == 'CLOSED')
                                                    <p><i> Closed </i></p>
                                                    <br>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>
                        <br>
                        {{ $jobs->links() }}
                    @else
                        <h1>Ooops !</h1>
                        <br>
                        <p> No jobs Defined Yet.</p>
                    @endif
                </div>
                <div class="card-footer">

                </div>


            </div>
        </div>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                let searchBtn = $('#searchBtn');
                searchBtn.click(function() {
                    let searchInput = $('input[name="search"]');
                    if (searchInput.val().length > 0) {
                        window.location.href = "/jobs?jobSearchParam=" + searchInput.val();
                    } else {
                        window.location.href = "/jobs";
                    }

                });

            });
        </script>
    @endsection
@endAuth
