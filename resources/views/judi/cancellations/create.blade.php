@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', ['title' => 'Create Cancellation'] )
        <div class="panel-body">
            {!! Form::open(array('route' => 'judi.cancellations.store')) !!}
            @include('judi/cancellations/partials/_form', ['submit' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>
@stop