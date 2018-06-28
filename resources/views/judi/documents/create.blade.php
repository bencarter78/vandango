@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Create Document' ] )
        <div class="panel-body">
            {!! Form::open(array('route' => 'judi.documents.store')) !!}
            @include('judi/documents/partials/_form', ['submit' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>
@stop