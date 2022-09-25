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
                        <table>
                            <thead>
                                <tr>

                                    <th>Business Code</th>
                                    <th>Business Name</th>
                                    <th>Business Description</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($businesses as $business)
                                    <tr>


                                        <td>
                                            {{ $business->biz_code }}</td>
                                        <td>
                                            {{ $business->biz_name }}</td>
                                        <td>
                                            {!!$business->biz_description !!}</td>
                                        <td>
                                            {{ $business->status }}</td>

                                        <td>
                                            @if ($business->CanEdit)
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <a
                                                        href="/businesses/{{ $business->id }}/edit?{{ $lastPageName }}={{ $businesses->currentPage() }}"><button
                                                            class='fa fa-pencil businessEditIcon'></button>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($business->CanDelete)
                                                <div class="d-flex align-items-center justify-content-center">
                                                    {!! Form::open([
                                                        'action' => ['App\Http\Controllers\BusinessesController@destroy', $business->id],
                                                        'method' => 'POST',
                                                        'id' => 'deleteBusiness',
                                                        'onSubmit' => 'return doSubmit(event, "deleteBusiness",' . json_encode($confirmDeleteMsg) . ')',
                                                    ]) !!}

                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::hidden($lastPageName, $businesses->currentPage()) }}
                                                    <button class='fa fa-close businessDeleteIcon' type="submit"></button>
                                                    {!! Form::close() !!}

                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
