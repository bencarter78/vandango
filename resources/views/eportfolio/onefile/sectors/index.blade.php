@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>OneFile Sector Centres</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Sector</th>
                        <th>Linked Centres</th>
                        @if($currentUser->hasAccess('eportfolioAdmin'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sectors as $sector)
                        <tr>
                            <td>{{ $sector->title }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach($sector->eportfolioCentres as $centre)
                                        <li>{{ $centre->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            @if($currentUser->hasAccess('eportfolioAdmin'))
                                <td class="text-center">
                                    <a class="is-link text-upper font-size-small" href={{ route('eportfolios.onefile.sectors.edit', $sector->id) }}>Edit</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer">

        </div>
    </div>
@stop