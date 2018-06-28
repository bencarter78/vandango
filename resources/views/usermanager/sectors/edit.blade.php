@extends('layouts.master')
@section('content')

{!! Form::model($sector, array('route' => array('sectors.update', $sector->id), 'method' => 'put') ) !!}
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Edit {!! $sector->code !!} Sector</h4></div>
        <div class="panel-body">
            @include('usermanager/sectors/partials/_form')
        </div>
        <div class="panel-footer">
            {!! Form::submit('Update', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>
{!! Form::close() !!}

@stop