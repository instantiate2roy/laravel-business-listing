@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/groupsScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class="card-header">
                            <div class="addNewGroupsBtn">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="/groups/create?{{ $lastPageName }}={{ $groups->currentPage() }}">
                                        <button class="btn btn-primary">
                                            <span class="fa fa-plus groupsCreateIcon" aria-hidden="true">
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="groupsCardTitle">Groups</div>
                        </div>
                        <div class="card-body">
                            @if ($groups->count() > 0)
                                {{ $groups->links() }}
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

                                        @foreach ($groups as $group)
                                            <tr>


                                                <td>
                                                    {{ $group->group_code }}</td>
                                                <td>
                                                    {{ $group->group_name }}</td>
                                                <td>
                                                    {{ $group->group_status }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <a
                                                            href="/groups/{{ $group->id }}/edit?{{ $lastPageName }}={{ $groups->currentPage() }}"><button
                                                                class='fa fa-pencil groupEditIcon'></button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\GroupsController@destroy', $group->id],
                                                            'method' => 'POST',
                                                            'id' => 'deleteGroup',
                                                            'onSubmit' => 'return doSubmit(event, "deleteGroup",' . json_encode($confirmDeleteMsg) . ')',
                                                        ]) !!}

                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::hidden($lastPageName, $groups->currentPage()) }}
                                                        <button class='fa fa-close groupDeleteIcon' type="submit"></button>
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
                                {{ $groups->links() }}
                            @else
                                <h1>Ooops !</h1>
                                <br>
                                <p> No Groups Defined Yet.</p>
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
