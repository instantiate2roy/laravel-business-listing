@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/ranksScreen.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class="card-header">
                            <div class="addNewRanksBtn">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="/ranks/create?{{$lastPageName}}={{$ranks->currentPage()}}">
                                        <button class="btn btn-primary">
                                            <span class="fa fa-plus ranksCreateIcon" aria-hidden="true">
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="ranksCardTitle">Ranks</div>
                        </div>
                        <div class="card-body">
                            @if ($ranks->count() > 0)
                                {{ $ranks->links() }}
                                <br>
                                <hr>
                                <br>
                                <table>
                                    <thead>
                                        <tr>

                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($ranks as $rank)
                                            <tr>


                                                <td>
                                                    {{ $rank->rank_number }}</td>
                                                <td>
                                                    {{ $rank->rank_name }}</td>
                                                <td>
                                                    {{ $rank->rank_status }}</td>
                                                
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <a href="/ranks/{{ $rank->id }}/edit?{{$lastPageName}}={{$ranks->currentPage()}}"><button
                                                                class='fa fa-pencil rankEditIcon'></button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\RanksController@destroy', $rank->id],
                                                            'method' => 'POST',
                                                            'id' => 'deleteRank',
                                                            'onSubmit' => 'return doSubmit(event, "deleteRank",' . json_encode($confirmDeleteMsg) . ')',
                                                        ]) !!}

                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::hidden($lastPageName, $ranks->currentPage()) }}
                                                        <button class='fa fa-close rankDeleteIcon' type="submit"></button>
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
                                {{ $ranks->links() }}
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
