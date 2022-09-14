@Auth
    @extends('layouts.app')
    @section('content')
        <link href="{{ asset('css/lookupScreens.css') }}" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-3">@include('inc.sidebar')</div>
                <div class="col-md-9">
                    <div class='card'>
                        <div class="card-header">
                            Lookup Items
                        </div>
                        <div class="card-body">
                            @if ($lookups->count() > 0)
                                {{ $lookups->links() }}
                                <br>
                                <hr>
                                <br>
                                <table>
                                    <thead>
                                        <tr>
                                            
                                            <th>Key</th>
                                            <th>Scope</th>
                                            <th>Short Description</th>
                                            <th>Full Description</th>
                                            <th colspan="2" class='createTH'>
                                                <a href="/lookups/create">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class="fa fa-plus createIcon" aria-hidden="true"></i>
                                                    </div></a>
                                                </th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($lookups as $lookup)
                                            <tr>

                                                
                                                <td>{{ $lookup->lk_key }}</td>
                                                <td>{{ $lookup->lk_scope }}</td>
                                                <td>{{ $lookup->lk_short_description }}</td>
                                                <td>{{ $lookup->lk_full_description }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center"><button
                                                            class='fa fa-pencil'></button>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {!! Form::open([
                                                            'action' => ['App\Http\Controllers\LookupsController@destroy', $lookup->lk_id],
                                                            'method' => 'POST',
                                                            'id' => 'deleteLookup',
                                                            'onSubmit' => 'return doSubmit(event, "deleteLookup",' . json_encode($confirmDeleteMsg) . ')',
                                                        ]) !!}

                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::hidden($lastPageName, $lookups->currentPage()) }}
                                                        <button class='fa fa-close deleteXIcon' type="submit"></button>
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
                                {{ $lookups->links() }}
                            @else
                                !Ooop No Lookup Define Yet.
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
