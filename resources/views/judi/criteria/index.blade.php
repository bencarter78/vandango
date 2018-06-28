@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [
			'access' => 'judiAdmin',
        	'title' => 'All Criteria',
            'titleClass' => '',
        	'buttonText' => 'Create Criteria',
        	'buttonRoute' =>  'judi.criteria.create',
            'buttonRouteParameters' => ''
        ] )

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Criteria</th>
                    @include('partials/tables/_th-actions', ['access' => 'judiAdmin'])
                </tr>
                </thead>
                @foreach($criteria as $criteriaElement)
                    <tr>
                        <td>{!! $criteriaElement->name !!}</td>
                        @include('partials/tables/_td-actions', [ 'route' => 'judi.criteria.edit', 'model' => $criteriaElement, 'access' => 'judiAdmin' ])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@include('partials/modals/_delete', [
	'model' => $criteria,
	'title' => 'Criteria',
	'route' => 'judi.criteria.destroy'
])
