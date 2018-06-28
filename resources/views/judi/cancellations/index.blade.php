@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [
        	'access' => 'judiAdmin',
            'title' => 'All Cancellations',
            'titleClass' => '',
        	'buttonText' => 'Create Cancellation Reason',
        	'buttonRoute' =>  'judi.cancellations.create',
        	'buttonRouteParameters' => ''
        ] )

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Type</th>
                    @include('partials/tables/_th-actions', ['access' => 'judiAdmin'])
                </tr>
                </thead>
                @foreach($cancellations as $cancellation)
                    <tr>
                        <td>{!! $cancellation->type !!}</td>
                        @include('partials/tables/_td-actions', [ 'route' => 'judi.cancellations.edit', 'model' => $cancellation, 'access' => 'judiAdmin' ])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@include('partials/modals/_delete', [
	'model' => $cancellations,
	'title' => 'Cancellation',
	'route' => 'judi.cancellations.destroy'
])