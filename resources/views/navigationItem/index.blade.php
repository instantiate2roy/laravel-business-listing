@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/navigationItemsScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class="card-header">
                            <div class="addNewNavigationItemsBtn">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="/navigationItems/create?{{ $lastPageName }}={{ $navigationItems->currentPage() }}">
                                        <button class="btn btn-primary">
                                            <span class="fa fa-plus navigationItemsCreateIcon" aria-hidden="true">
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="navigationItemsCardTitle">Navigation Menus</div>
                        </div>
                        <div class="card-body">
                            @if ($navigationItems->count() > 0)
                                {{ $navigationItems->links() }}
                                <br>
                                <hr>
                                <br>
                                <table>
                                    <thead>
                                        <tr>

                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Url</th>
                                            <th>Parent Menu</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($navigationItems as $navigationItem)
                                            <tr>


                                                <td>
                                                    {{ $navigationItem->nav_code }}</td>
                                                <td>
                                                    {{ $navigationItem->nav_name }}</td>
                                                <td>
                                                    {{ $navigationItem->nav_url }}</td>
                                                <td>
                                                    {{ $navigationItem->NavigationMenu }}</td>
                                                <td>
                                                    {{ $navigationItem->NavigationItemStatus }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <a
                                                            href="/navigationItems/{{ $navigationItem->id }}/edit?{{ $lastPageName }}={{ $navigationItems->currentPage() }}"><button
                                                                class='fa fa-pencil navigationItemEditIcon'></button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\NavigationItemsController@destroy', $navigationItem->id],
                                                            'method' => 'POST',
                                                            'id' => 'deleteNavigationItem',
                                                            'onSubmit' => 'return doSubmit(event, "deleteNavigationItem",' . json_encode($confirmDeleteMsg) . ')',
                                                        ]) !!}

                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::hidden($lastPageName, $navigationItems->currentPage()) }}
                                                        <button class='fa fa-close navigationItemDeleteIcon'
                                                            type="submit"></button>
                                                        {!! Form::close() !!}

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <br>
                                <hr>
                                <br>
                                {{ $navigationItems->links() }}
                            @else
                                <h1>Ooops !</h1>
                                <br>
                                <p> No Navigation Menus Defined Yet.</p>
                            @endif
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endAuth
