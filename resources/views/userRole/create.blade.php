@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/userRolesScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class='card-header'>
                            <div class="userRolesBackButton">
                                <a href="/userRoles?{{ $paginationPageName }}={{ $lastPage }}">
                                    <button class="btn btn-primary">
                                        <span class="fa fa-arrow-left" aria-hidden="true">
                                        </span> Go Back
                                    </button>
                                </a>
                            </div>
                            <div class="userRolesCardTitle">Create New rank</div>
                        </div>
                        <div class='card-body'>
                            {!! Form::open(['action' => 'App\Http\Controllers\UserRolesController@store', 'method' => 'POST']) !!}


                            <div class="form-group">
                                {!! Form::label('ur_userid', 'User') !!}
                                {!! Form::select('ur_userid', $usersLookup, '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('ur_rolecode', 'Role') !!}
                                {!! Form::select('ur_rolecode', $userRoleLookups, '', [
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
