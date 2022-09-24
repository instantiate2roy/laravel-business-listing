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
                    <div class="businessesCardTitle">Update Business</div>
                </div>
                <div class='card-body'>
                    {!! Form::open([
                        'action' => ['App\Http\Controllers\BusinessesController@update', $business->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}


                    <div class="form-group">
                        {!! Form::label('biz_code', 'Business Code') !!}
                        {!! Form::text('biz_code', $business->biz_code, ['class' => 'form-control']) !!}
                    </div>
                    <br>

                    <div class="form-group">
                        {!! Form::label('biz_name', 'Business Name') !!}
                        {!! Form::text('biz_name', $business->biz_name, ['class' => 'form-control', 'placeholder' => 'Business Name']) !!}
                    </div>
                    <br>

                    <div class="form-group">
                        {!! Form::label('biz_status', 'Business Status') !!}

                        {!! Form::select('biz_status', $businessStatusLookups, $business->biz_status, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <br>
                    <div class="form-group">
                        {{ Form::label('biz_image_path', 'Business Display Image') }}
                        {{ Form::file('biz_image_path') }}
                    </div>
                    <br>
                    {{ Form::hidden($lastPageName, $lastPage) }}
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
                <div class='card-footer'></div>
            </div>



        </div>
    @endsection
@endAuth
