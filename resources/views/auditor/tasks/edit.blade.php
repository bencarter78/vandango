@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Edit Task' ] )
        <div class="panel-body">
            {!! Form::model($task, ['route' => ['auditor.tasks.update', $task->id], 'method' => 'patch'] ) !!}
            @include('auditor/tasks/partials/_form', ['submit' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>

@stop