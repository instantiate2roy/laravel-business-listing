@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/navigationMenusScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class='card-header'>
                            <div class="navigationMenusBackButton">
                                <a href="/navigationMenus?{{ $paginationPageName }}={{ $lastPage }}">
                                    <button class="btn btn-primary">
                                        <span class="fa fa-arrow-left" aria-hidden="true">
                                        </span> Go Back
                                    </button>
                                </a>
                            </div>
                            <div class="navigationMenusCardTitle">Update navigation Menu</div>
                        </div>
                        <div class='card-body'>
                            {!! Form::open(['action' => ['App\Http\Controllers\NavigationMenusController@update', $navigationMenu->id], 'method' => 'PUT']) !!}


                            <div class="form-group">
                                {!! Form::label('menu_code', 'Menu code') !!}
                                {!! Form::text('menu_code', $navigationMenu->menu_code, ['class' => 'form-control', 'disabled' => true]) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('menu_name', 'Menu Name') !!}
                                {!! Form::text('menu_name', $navigationMenu->menu_name, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Menu Name',
                                    'required' => true,
                                ]) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('menu_status', 'Menu Status') !!}

                                {!! Form::select('menu_status', $navigationMenuStatusLookups, $navigationMenu->menu_status, [
                                    'class' => 'form-control',
                                    'required' => true,
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
