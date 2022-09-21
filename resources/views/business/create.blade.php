@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/groupsScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class='card-header'>
                            <div class="groupsBackButton">
                                <a href="/groups?{{ $paginationPageName }}={{ $lastPage }}">
                                    <button class="btn btn-primary">
                                        <span class="fa fa-arrow-left" aria-hidden="true">
                                        </span> Go Back
                                    </button>
                                </a>
                            </div>
                            <div class="groupsCardTitle">Create New Group</div>
                        </div>
                        <div class='card-body'>
                            {!! Form::open(['action' => 'App\Http\Controllers\GroupsController@store', 'method' => 'POST']) !!}


                            <div class="form-group">
                                {!! Form::label('group_code', 'Group Code') !!}
                                {!! Form::text('group_code', '', ['class' => 'form-control','Placeholder'=>'Group Code']) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('group_name', 'Group Name') !!}
                                {!! Form::text('group_name', '', ['class' => 'form-control', 'placeholder' => 'Group Name']) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('group_status', 'Group Status') !!}

                                {!! Form::select('group_status', $groupStatusLookups, '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <br>
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class='card-footer'></div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
@endAuth
