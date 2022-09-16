@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/lookupScreens.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">

                </div>
            </div>
        </div>
    @endsection
@endAuth
