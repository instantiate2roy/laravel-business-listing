@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/navigationMenusScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class="card-header">
                            <div class="addNewNavigationMenusBtn">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="/navigationMenus/create?{{$lastPageName}}={{$navigationMenus->currentPage()}}">
                                        <button class="btn btn-primary">
                                            <span class="fa fa-plus navigationMenusCreateIcon" aria-hidden="true">
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="navigationMenusCardTitle">Navigation Menus</div>
                        </div>
                        <div class="card-body">
                            @if ($navigationMenus->count() > 0)
                                {{ $navigationMenus->links() }}
                                <br>
                                <hr>
                                <br>
                                <table>
                                    <thead>
                                        <tr>

                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($navigationMenus as $navigationMenu)
                                            <tr>


                                                <td>
                                                    {{ $navigationMenu->menu_code }}</td>
                                                <td>
                                                    {{ $navigationMenu->menu_name }}</td>
                                                <td>
                                                    {{ $navigationMenu->StatusName }}</td>
                                                
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <a href="/navigationMenus/{{ $navigationMenu->id }}/edit?{{$lastPageName}}={{$navigationMenus->currentPage()}}"><button
                                                                class='fa fa-pencil navigationMenuEditIcon'></button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\NavigationMenusController@destroy', $navigationMenu->id],
                                                            'method' => 'POST',
                                                            'id' => 'deleteNavigationMenu',
                                                            'onSubmit' => 'return doSubmit(event, "deleteNavigationMenu",' . json_encode($confirmDeleteMsg) . ')',
                                                        ]) !!}

                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::hidden($lastPageName, $navigationMenus->currentPage()) }}
                                                        <button class='fa fa-close navigationMenuDeleteIcon' type="submit"></button>
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
                                {{ $navigationMenus->links() }}
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
