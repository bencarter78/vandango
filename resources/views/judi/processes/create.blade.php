@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h4>Create A New Process</h4></div>
        {!! Form::open(array('route' => 'judi.processes.store')) !!}
        <div class="panel-body">
            @include('judi/processes/partials/_form')
        </div>
        <div class="panel-footer">
            {!! Form::submit('Create', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
        {!! Form::close() !!}
    </div>

@stop