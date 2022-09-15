@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/lookupScreens.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class='card-header'>
                            <div class="lookupBackButton">
                                <a href="/lookups?{{ $paginationPageName }}={{ $lastPage }}">
                                    <button class="btn btn-primary">
                                        <span class="fa fa-arrow-left" aria-hidden="true">
                                        </span> Go Back
                                    </button>
                                </a>
                            </div>
                            <div class="lookupCardTitle">Edit Lookup
                            </div>
                        </div>
                        <div class='card-body'>
                            {!! Form::open([
                                'action' => ['App\Http\Controllers\LookupsController@update', $lookup->id],
                                'method' => 'PUT',
                            ]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('lk_key', 'Lookup Key') !!}
                                        {!! Form::text('lk_key', $lookup->lk_key, [
                                            'class' => 'form-control',
                                            'placeholder' => 'key',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('lk_scope', 'Lookup Scope') !!}
                                        {!! Form::text('lk_scope', $lookup->lk_scope, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Scope',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('lk_short_description', 'Short Description') !!}
                                        {!! Form::text('lk_short_description', $lookup->lk_short_description, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Short Description',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        {!! Form::label('lk_full_description', 'Full Description') !!}
                                        {!! Form::textarea('lk_full_description', $lookup->lk_full_description, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Full Description',
                                            'rows' => '5',
                                        ]) !!}
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        {!! Form::label('lk_category1', 'Category 1') !!}
                                        {!! Form::text('lk_category1', $lookup->lk_category1, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Category 1',
                                        ]) !!}
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('lk_category2', 'Category 2') !!}
                                        {!! Form::text('lk_category2', $lookup->lk_category2, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Category 2',
                                        ]) !!}
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        {!! Form::label('lk_category3', 'Category 3') !!}
                                        {!! Form::text('lk_category', $lookup->lk_category3, ['class' => 'form-control', 'placeholder' => 'Category 3']) !!}
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('lk_category4', 'Category 4') !!}
                                        {!! Form::text('lk_category4', $lookup->lk_category4, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Category 4',
                                        ]) !!}
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        {!! Form::label('lk_category5', 'Category 5') !!}
                                        {!! Form::text('lk_category5', $lookup->lk_category5, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Category 5',
                                        ]) !!}
                                    </div>
                                    <br>

                                </div>
                            </div>
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
