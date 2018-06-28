@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [
			'access' => 'judiAdmin',
        	'title' => 'All Reports',
            'titleClass' => '',
        	'buttonText' => 'Create Report',
        	'buttonRoute' =>  'judi.reports.create',
            'buttonRouteParameters' => ''
        ] )

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Report</th>
                    @include('partials/tables/_th-actions', ['access' => 'judiAdmin'])
                </tr>
                </thead>
                @foreach($reports as $report)
                    <tr>
                        <td>{!! link_to_route('judi.reports.show', $report->title, $report->id) !!}</td>
                        @include('partials/tables/_td-actions', [ 'route' => 'judi.reports.edit', 'model' => $report, 'access' => 'judiAdmin' ])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@include('partials/modals/_delete', [
	'model' => $reports,
	'title' => 'Report',
	'route' => 'judi.reports.destroy'
])
