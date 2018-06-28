@extends('layouts.master')
@section('content')

    {!! Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'put') ) !!}
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Edit {!! $role->job_role !!}</h4></div>
        <div class="panel-body">
            @include('usermanager/roles/partials/_form')
        </div>
        <div class="panel-footer">
            {!! Form::submit('Update', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>
    {!! Form::close() !!}

@stop