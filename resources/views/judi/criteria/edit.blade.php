@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Edit Criteria' ] )
        <div class="panel-body">
            {!! Form::model($criteria, array('route' => array('judi.criteria.update', $criteria->id), 'method' => 'put') ) !!}
            @include('judi/criteria/partials/_form', ['submit' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>
@stop