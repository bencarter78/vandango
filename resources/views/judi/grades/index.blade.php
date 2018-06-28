@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [
			'access' => 'judiAdmin',
        	'title' => 'All Grades',
            'titleClass' => '',
        	'buttonText' => 'Create Grade',
        	'buttonRoute' =>  'judi.grades.create',
        	'buttonRouteParameters' => ''
        ] )

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Grade</th>
                    @include('partials/tables/_th-actions', ['access' => 'judiAdmin'])
                </tr>
                </thead>
                @foreach($grades as $grade)
                    <tr>
                        <td>{!! $grade->name !!}</td>
                        @include('partials/tables/_td-actions', [ 'route' => 'judi.grades.edit', 'model' => $grade, 'access' => 'judiAdmin' ])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@include('partials/modals/_delete', [
	'model' => $grades,
	'title' => 'Grade',
	'route' => 'judi.grades.destroy'
])
