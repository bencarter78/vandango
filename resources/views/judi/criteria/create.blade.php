@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Create Criteria' ] )
        <div class="panel-body">
            {!! Form::open(array('route' => 'judi.criteria.store')) !!}
            @include('judi/criteria/partials/_form', ['submit' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>
@stop