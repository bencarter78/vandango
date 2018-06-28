@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Edit Report' ] )
        <div class="panel-body">
            {!! Form::model($report, array('route' => array('judi.reports.update', $report->id), 'method' => 'put') ) !!}
            @include('judi/reports/partials/_form', ['submit' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>
@stop