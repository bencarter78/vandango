@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Edit Document' ] )
        <div class="panel-body">
            {!! Form::model($document, array('route' => array('judi.documents.update', $document->id), 'method' => 'put') ) !!}
            @include('judi/documents/partials/_form', ['submit' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>
@stop