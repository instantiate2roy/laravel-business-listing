@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/rolesScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class="card-header">
                            <div class="addNewRolesBtn">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="/roles/create?{{ $lastPageName }}={{ $roles->currentPage() }}">
                                        <button class="btn btn-primary">
                                            <span class="fa fa-plus rolesCreateIcon" aria-hidden="true">
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="rolesCardTitle">Roles</div>
                        </div>
                        <div class="card-body">
                            @if ($roles->count() > 0)
                                {{ $roles->links() }}
                                <br>
                                <hr>
                                <br>
                                <table>
                                    <thead>
                                        <tr>

                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Rank</th>
                                            <th>Group</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($roles as $role)
                                            <tr>


                                                <td>
                                                    {{ $role->role_code }}</td>
                                                <td>
                                                    {{ $role->role_name }}</td>
                                                <td>
                                                    {{ $role->role_rank }}</td>
                                                <td>
                                                    {{ $role->role_group }}</td>
                                                <td>
                                                    {{ $role->role_status }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <a
                                                            href="/roles/{{ $role->id }}/edit?{{ $lastPageName }}={{ $roles->currentPage() }}"><button
                                                                class='fa fa-pencil roleEditIcon'></button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\RolesController@destroy', $role->id],
                                                            'method' => 'POST',
                                                            'id' => 'deleteRole',
                                                            'onSubmit' => 'return doSubmit(event, "deleteRole",' . json_encode($confirmDeleteMsg) . ')',
                                                        ]) !!}

                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::hidden($lastPageName, $roles->currentPage()) }}
                                                        <button class='fa fa-close roleDeleteIcon' type="submit"></button>
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
                                {{ $roles->links() }}
                            @else
                                !Ooop No Ranks Defined Yet.
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
