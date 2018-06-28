@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Edit Grade' ] )
        <div class="panel-body">
            {!! Form::model($cancellation, array('route' => array('judi.cancellations.update', $cancellation->id), 'method' => 'put') ) !!}
            @include('judi/cancellations/partials/_form', ['submit' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>
@stop