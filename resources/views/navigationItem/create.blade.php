@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/navigationItemsScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class='card-header'>
                            <div class="navigationItemsBackButton">
                                <a href="/navigationItems?{{ $paginationPageName }}={{ $lastPage }}">
                                    <button class="btn btn-primary">
                                        <span class="fa fa-arrow-left" aria-hidden="true">
                                        </span> Go Back
                                    </button>
                                </a>
                            </div>
                            <div class="navigationItemsCardTitle">Create New Navigation Item</div>
                        </div>
                        <div class='card-body'>
                            {!! Form::open(['action' => 'App\Http\Controllers\NavigationItemsController@store', 'method' => 'POST']) !!}


                            <div class="form-group">
                                {!! Form::label('nav_code', 'Item code') !!}
                                {!! Form::text('nav_code', '', ['class' => 'form-control', 'placeholder' => 'Item code', 'required' => true]) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('nav_name', 'Item Name') !!}
                                {!! Form::text('nav_name', '', ['class' => 'form-control', 'placeholder' => 'Item Name', 'required' => true]) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('nav_url', 'Item Url') !!}
                                {!! Form::text('nav_url', '', ['class' => 'form-control', 'placeholder' => 'Item Url']) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('nav_menu', 'Item Parent menu') !!}
                                {!! Form::select('nav_menu', $navigationItemMenuLookups, '', [
                                    'class' => 'form-control',
                                    'required' => true,
                                ]) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('nav_status', 'Item Status') !!}

                                {!! Form::select('nav_status', $navigationItemStatusLookups, '', [
                                    'class' => 'form-control',
                                    'required' => true,
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
