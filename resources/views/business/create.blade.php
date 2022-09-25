@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/businessesScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class='card'>
                <div class='card-header'>
                    <div class="businessesBackButton">
                        <a href="/businesses?{{ $paginationPageName }}={{ $lastPage }}">
                            <button class="btn btn-primary">
                                <span class="fa fa-arrow-left" aria-hidden="true">
                                </span> Go Back
                            </button>
                        </a>
                    </div>
                    <div class="businessesCardTitle">Create New Business</div>
                </div>
                <div class='card-body'>
                    {!! Form::open([
                        'action' => 'App\Http\Controllers\BusinessesController@store',
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                    ]) !!}


                    <div class="form-group">
                        {!! Form::label('biz_code', 'Business Code') !!}
                        {!! Form::text('biz_code', '', ['class' => 'form-control', 'Placeholder' => 'Business Code']) !!}
                    </div>
                    <br>

                    <div class="form-group">
                        {!! Form::label('biz_name', 'Business Name') !!}
                        {!! Form::text('biz_name', '', ['class' => 'form-control', 'placeholder' => 'Business Name']) !!}
                    </div>
                    <br>

                    <div class="form-group">
                        {!! Form::label('biz_description', 'Business Description') !!}
                        {!! Form::textarea('biz_description', '', ['class' => 'form-control', 'id' => 'ck_editor_element']) !!}
                    </div>
                    <br>

                    <div class="form-group">
                        {{ Form::label('biz_image_path', 'Business Display Image') }}
                        {{ Form::file('biz_image_path') }}
                    </div>
                    <br>
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
                <div class='card-footer'></div>
            </div>



        </div>
    @endsection
@endAuth
