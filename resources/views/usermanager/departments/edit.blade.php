@extends('layouts.master')
@section('content')

    {!! Form::model($department, array('route' => array('departments.update', $department->id), 'method' => 'put') ) !!}
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Edit {!! $department->department !!} Department</h4></div>
        <div class="panel-body">
            @include('usermanager/departments/partials/_form')
        </div>
        <div class="panel-footer">
            {!! Form::submit('Update', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>
    {!! Form::close() !!}

@stop