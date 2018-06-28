@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-upper weight-bold">Vacancies By Sector</h5>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Sector</th>
                                <th class="text-right">Live
                                    <small>(Volume)</small>
                                </th>
                                <th class="text-right">Closed
                                    <small>(Volume)</small>
                                </th>
                                <th class="text-right">Hired
                                    <small>(Volume)</small>
                                </th>
                                <th class="text-right">Closed Conversion
                                    <small>(%)</small>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sectors as $sector)
                                <tr>
                                    <td>{{ $sector->title }}</td>
                                    <td class="text-right">{{ $sector->vacanciesLive()->sum->positions_count }}</td>
                                    <td class="text-right">{{ $sector->vacanciesClosed()->sum->positions_count }}</td>
                                    <td class="text-right">{{ $sector->totalHired() }}</td>
                                    <td class="text-right">{{ $sector->vacancyConversionRate() }}%</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>TOTAL</th>
                                <th class="text-right">
                                    {{
                                        $sectors->reduce(function($carry, $sector) {
                                            return $carry + $sector->vacanciesLive()->sum->positions_count;
                                        }, 0)
                                    }}
                                </th>
                                <th class="text-right">
                                    {{
                                        $sectors->reduce(function($carry, $sector) {
                                            return $carry + $sector->vacanciesClosed()->sum->positions_count;
                                        }, 0)
                                    }}
                                </th>
                                <th class="text-right">
                                    {{
                                        $sectors->reduce(function($carry, $sector) {
                                            return $carry + $sector->totalHired();
                                        }, 0)
                                    }}
                                </th>
                                <th class="text-right">
                                    {{
                                        number_format(
                                            $sectors->reduce(function($carry, $sector) {
                                                return $carry + $sector->totalHired();
                                            }, 0) /
                                            $sectors->reduce(function($carry, $sector) {
                                                return $carry + $sector->vacanciesClosed()->sum->positions_count;
                                            }, 0) * 100
                                        )
                                    }}%
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-upper weight-bold">Vacancies By Application Manager</h5>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Application Manager</th>
                                <th class="text-right">Live
                                    <small>(Volume)</small>
                                </th>
                                <th class="text-right">Closed
                                    <small>(Volume)</small>
                                </th>
                                <th class="text-right">Hired
                                    <small>(Volume)</small>
                                </th>
                                <th class="text-right">Closed Conversion
                                    <small>(%)</small>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applicationManagers as $am)
                                <tr>
                                    <td>{{ $am->first_name }} {{ $am->surname }}</td>
                                    <td class="text-right">{{ $am->vacanciesLive()->sum->positions_count }}</td>
                                    <td class="text-right">{{ $am->vacanciesClosed()->sum->positions_count }}</td>
                                    <td class="text-right">{{ $am->totalHired() }}</td>
                                    <td class="text-right">{{ $am->vacancyConversionRate() }}%</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>TOTAL</th>
                                <th class="text-right">
                                    {{
                                        $applicationManagers->reduce(function($carry, $am) {
                                            return $carry + $am->vacanciesLive()->sum->positions_count;
                                        }, 0)
                                    }}
                                </th>
                                <th class="text-right">
                                    {{
                                        $applicationManagers->reduce(function($carry, $am) {
                                            return $carry + $am->vacanciesClosed()->sum->positions_count;
                                        }, 0)
                                    }}
                                </th>
                                <th class="text-right">
                                    {{
                                        $applicationManagers->reduce(function($carry, $am) {
                                            return $carry + $am->totalHired();
                                        }, 0)
                                    }}
                                </th>
                                <th class="text-right">
                                    {{
                                        number_format(
                                            $sectors->reduce(function($carry, $sector) {
                                                return $carry + $sector->totalHired();
                                            }, 0) /
                                            $sectors->reduce(function($carry, $sector) {
                                                return $carry + $sector->vacanciesClosed()->sum->positions_count;
                                            }, 0) * 100
                                        )
                                    }}%
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop