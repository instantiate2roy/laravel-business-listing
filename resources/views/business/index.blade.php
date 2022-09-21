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
                        <br>





                        @foreach ($businesses as $business)
                            <div
                                class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col-auto d-none d-lg-block">
                                    <img class="bd-placeholder-img" width="200" height="250"
                                        src="/storage/{{ $business->biz_image_path }}" role="img" aria-label="Placeholder: Thumbnail"
                                        preserveAspectRatio="xMidYMid slice" focusable="false">

                                </div>
                                <div class="col p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-success">{{ $business->name }}</strong>
                                    



                                </div>

                            </div>
                        @endforeach


                        <br>
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
