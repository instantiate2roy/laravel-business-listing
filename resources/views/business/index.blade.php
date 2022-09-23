@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/businessesScreen.css') }}" rel="stylesheet">
        <div class="container">

            <div class='card'>
                <div class="card-header">
                    <div class="addNewBusinessesBtn">
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="/businesses/create?{{ $lastPageName }}={{ $businesses->currentPage() }}">
                                <button class="btn btn-primary">
                                    <span class="fa fa-plus businessesCreateIcon" aria-hidden="true">
                                    </span>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="businessesCardTitle">Businesses</div>
                </div>
                <div class="card-body">
                    @if ($businesses->count() > 0)
                        {{ $businesses->links() }}
                        <br>
                        <hr>

                        @foreach ($businesses as $business)
                            
                        @endforeach
                        <hr>
                        <br>
                        {{ $businesses->links() }}
                    @else
                        <h1>Ooops !</h1>
                        <br>
                        <p> No Businesses Defined Yet.</p>
                    @endif
                </div>
                <div class="card-footer">

                </div>


            </div>
        </div>
    @endsection
@endAuth
