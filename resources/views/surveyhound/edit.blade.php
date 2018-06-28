@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [
            'title' => 'Edit Survey',
        ] )
        <div class="panel-body">
            {!! Form::model($survey, [ 'route' => [ 'surveyhound.update', $survey->id ], 'method' => 'put' ] ) !!}
            @include('surveyhound.partials._form', ['submit' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>

@stop