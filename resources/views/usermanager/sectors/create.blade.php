@extends('layouts.master')
@section('content')
    
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Create Sector</h4></div>
        <div class="panel-body">
            {!! Form::open(array('route' => 'sectors.store')) !!}
                @include('usermanager/sectors/partials/_form')
                {!! Form::submit('Create', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop