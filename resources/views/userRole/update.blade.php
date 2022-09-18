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
                            <div class="userRolesCardTitle">Update User Role</div>
                        </div>
                        <div class='card-body'>
                            {!! Form::open([
                                'action' => ['App\Http\Controllers\UserRolesController@update', $userRole->id],
                                'method' => 'PUT',
                            ]) !!}


                            <div class="form-group">
                                {!! Form::label('ur_userid', 'User') !!}
                                {!! Form::select('ur_userid', $usersLookup, $userRole->ur_userid, [
                                    'class' => 'form-control',
                                    'disabled'=>'true'
                                ]) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('ur_rolecode', 'Role') !!}
                                {!! Form::select('ur_rolecode', $userRoleLookups, $userRole->ur_rolecode, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <br>
                            {{ Form::hidden($lastPageName, $lastPage) }}
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
