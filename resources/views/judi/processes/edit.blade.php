@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h4>Edit {!! $process->name !!}</h4></div>
        {!! Form::model($process, array('route' => array('judi.processes.update', $process->id), 'method' => 'put') ) !!}
        <div class="panel-body">
            @include('judi/processes/partials/_form')
        </div>
        <div class="panel-footer">
            {!! Form::submit('Update', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
        {!! Form::close() !!}
    </div>

@stop