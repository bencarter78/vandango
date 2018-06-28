@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Create A New Auditor Task', 'access' => 'auditorAdmin' ] )
        <div class="panel-body">
            {!! Form::open(array('route' => 'auditor.tasks.store')) !!}
            @include('auditor/tasks/partials/_form', ['submit' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>

@stop