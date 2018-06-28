@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Edit Grade' ] )
        <div class="panel-body">
            {!! Form::model($grade, array('route' => array('judi.grades.update', $grade->id), 'method' => 'put') ) !!}
                @include('judi/grades/partials/_form', ['submit' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>
@stop