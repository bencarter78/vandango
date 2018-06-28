@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Create Report' ] )
        <div class="panel-body">
            {!! Form::open(array('route' => 'judi.reports.store')) !!}
            @include('judi/reports/partials/_form', ['submit' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>
@stop