@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Create Grade' ] )
        <div class="panel-body">
            {!! Form::open(array('route' => 'judi.grades.store')) !!}
            @include('judi/grades/partials/_form', ['submit' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>
@stop