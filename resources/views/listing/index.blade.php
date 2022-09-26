@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/listingsScreen.css') }}" rel="stylesheet">
        <div class="container">

            <div class='card'>
                <div class="card-header">
                    <div class="businessesCardSearch">
                        <input type="text" placeholder="Search.." value='{{ $listings->prevSearch }}' name="search">
                        <button class="btn btn-secondary" id='searchBtn'><i class="fa fa-search"></i></button>
                    </div>
                    <div class="businessesCardTitle">Listings</div>
                </div>
                <div class="card-body">
                    @if ($listings->count() > 0)
                        {{ $listings->links() }}
                        <br>
                        <hr>

                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col"></th>
                                    <th scope="col">Business Details</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($listings as $listing)
                                    <tr class="inner-box">

                                        <td width="25%">
                                            <div class="event-img">
                                                <img src="/storage/{{ $listing->biz_image_path }}" alt="" width="200"
                                                    height="200" />
                                            </div>
                                        </td>
                                        <td width="60%">
                                            <div class="event-wrap">
                                                <h2><strong><u>{{ $listing->biz_name }}</strong></u></h2>
                                                <div class="meta">
                                                    <p>{!! $listing->biz_description !!}</p>
                                                    <div class="organizers">
                                                        <a href="#">{{ $listing->owner }}</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                        <td width="15%">
                                            <div class="primary-btn">
                                                <a class="btn btn-success"
                                                    style="display: flex;
                                                    justify-content: center;
                                                    align-items: center;      
                                                    align-content: center;"
                                                    href="/jobs/create?{{ $lastPageName }}={{ $listings->currentPage() }}&b={{ $listing->biz_code }}">Offer
                                                    Job</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>
                        <br>
                        {{ $listings->links() }}
                    @else
                        <h1>Ooops !</h1>
                        <br>
                        <p> No listings Defined Yet.</p>
                    @endif
                </div>
                <div class="card-footer">

                </div>


            </div>
        </div>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                let searchBtn = $('#searchBtn');
                searchBtn.click(function() {
                    let searchInput = $('input[name="search"]');
                    if (searchInput.val().length > 0) {
                        window.location.href = "/listings?listingSearchParam=" + searchInput.val();
                    } else {
                        window.location.href = "/listings";
                    }

                });

            });
        </script>
    @endsection
@endAuth
