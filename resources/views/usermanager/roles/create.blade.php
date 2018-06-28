@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h4>Create Job Role</h4></div>
        <div class="panel-body">
            {!! Form::open(array('route' => 'roles.store')) !!}
            @include('usermanager/roles/partials/_form')
            {!! Form::submit('Create', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop