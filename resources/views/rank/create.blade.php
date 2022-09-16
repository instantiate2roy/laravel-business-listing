@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/ranksScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class='card-header'>
                            <div class="ranksBackButton">
                                <a href="/ranks?{{ $paginationPageName }}={{ $lastPage }}">
                                    <button class="btn btn-primary">
                                        <span class="fa fa-arrow-left" aria-hidden="true">
                                        </span> Go Back
                                    </button>
                                </a>
                            </div>
                            <div class="ranksCardTitle">Create New rank</div>
                        </div>
                        <div class='card-body'>
                            {!! Form::open(['action' => 'App\Http\Controllers\RanksController@store', 'method' => 'POST']) !!}


                            <div class="form-group">
                                {!! Form::label('rank_number', 'Rank Number') !!}
                                {!! Form::number('rank_number', '', ['class' => 'form-control']) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('rank_name', 'Rank Name') !!}
                                {!! Form::text('rank_name', '', ['class' => 'form-control', 'placeholder' => 'Rank Name']) !!}
                            </div>
                            <br>

                            <div class="form-group">
                                {!! Form::label('rank_status', 'Rank Status') !!}

                                {!! Form::select('rank_status', $rankStatusLookups, '', [
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
