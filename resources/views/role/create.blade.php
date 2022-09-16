@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/rolesScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class='card-header'>
                            <div class="rolesBackButton">
                                <a href="/roles?{{ $paginationPageName }}={{ $lastPage }}">
                                    <button class="btn btn-primary">
                                        <span class="fa fa-arrow-left" aria-hidden="true">
                                        </span> Go Back
                                    </button>
                                </a>
                            </div>
                            <div class="rolesCardTitle">Create New Role</div>
                        </div>
                        <div class='card-body'>
                            {!! Form::open(['action' => 'App\Http\Controllers\RolesController@store', 'method' => 'POST']) !!}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('role_code', 'Role Code') !!}
                                        {!! Form::text('role_code', '', ['class' => 'form-control', 'placeholder' => 'Role code']) !!}
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('role_name', 'Role Name') !!}
                                        {!! Form::text('role_name', '', ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('role_rank', 'Role Rank') !!}

                                        {!! Form::select('role_rank', $roleRankLookups, '', [
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('role_group', 'Role group') !!}

                                        {!! Form::select('role_group', $roleGroupLookups, '', [
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        {!! Form::label('role_status', 'Role Status') !!}

                                        {!! Form::select('role_status', $roleStatusLookups, '', ['class' => 'form-control']) !!}
                                    </div>
                                    <br>

                                </div>
                                <br>
                            </div>
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
