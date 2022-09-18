@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/userRolesScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class="card-header">
                            <div class="addNewUserRolesBtn">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="/userRoles/create?{{ $lastPageName }}={{ $userRoles->currentPage() }}">
                                        <button class="btn btn-primary">
                                            <span class="fa fa-plus userRolesCreateIcon" aria-hidden="true">
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="userRolesCardTitle">User Roles</div>
                        </div>
                        <div class="card-body">
                            @if ($userRoles->count() > 0)
                                {{ $userRoles->links() }}
                                <br>
                                <hr>
                                <br>
                                <table>
                                    <thead>
                                        <tr>

                                            <th>User</th>
                                            <th>Role</th>
                                            <th>Edit</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($userRoles as $userRole)
                                            <tr>


                                                <td>
                                                    {{ $userRole->UserName }}</td>
                                                <td>
                                                    {{ $userRole->RoleName }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <a
                                                            href="/userRoles/{{ $userRole->id }}/edit?{{ $lastPageName }}={{ $userRoles->currentPage() }}"><button
                                                                class='fa fa-pencil userRoleEditIcon'></button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\UserRolesController@destroy', $userRole->id],
                                                            'method' => 'POST',
                                                            'id' => 'deleteUserRole',
                                                            'onSubmit' => 'return doSubmit(event, "deleteUserRole",' . json_encode($confirmDeleteMsg) . ')',
                                                        ]) !!}

                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::hidden($lastPageName, $userRoles->currentPage()) }}
                                                        <button class='fa fa-close userRoleDeleteIcon' type="submit"></button>
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
                                {{ $userRoles->links() }}
                            @else
                                <h1>Ooops !</h1>
                                <br>
                                <p> No User Roles Defined Yet.</p>
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
