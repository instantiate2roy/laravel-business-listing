@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/listingsScreen.css') }}" rel="stylesheet">
        <div class="container">

            <div class='card'>
                <div class="card-header">
                    <div class="businessesCardSearch">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="businessesCardTitle">Listings</div>
                </div>
                <div class="card-body">
                    @if ($listings->count() > 0)
                        {{ $listings->links() }}
                        <br>
                        <hr>
                        <table>
                            <thead>
                                <tr>

                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Status</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listings as $listing)
                                    <tr>


                                        <td>
                                            {{ $listing->biz_code }}</td>
                                        <td>
                                            {{ $listing->biz_name }}</td>
                                        <td>
                                            {{ $listing->status }}</td>


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
    @endsection
@endAuth
