@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/jobsScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class='card'>
                <div class='card-header'>
                    <div class="jobsCardTitle">Offer Job</div>
                </div>
                <div class='card-body'>
                    {!! Form::open([
                        'action' => 'App\Http\Controllers\JobsController@store',
                        'method' => 'POST',
                    ]) !!}
                    <div class="form-group">
                        <div style="width:50%;">
                        {!! Form::label('job_business', 'Business Name') !!}
                        <br>
                        <p>{{$business->biz_name}}</p>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        {!! Form::label('job_details', 'Job Description/Details') !!}
                        {!! Form::textarea('job_details', '', ['class' => 'form-control', 'id' => 'ck_editor_element']) !!}
                    </div>
                    <br>

                    <div class="form-group">
                        <div style="width:50%;">
                        {{ Form::label('job_expiry', 'Expiry Date') }}
                        <input class="form-control" type="datetime-local" name="job_expiry" required>
                        </div>
                    </div>
                    <br>
                    {{ Form::hidden('job_business', $business->biz_code) }}
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
                <div class='card-footer'></div>
            </div>



        </div>
    @endsection
@endAuth
