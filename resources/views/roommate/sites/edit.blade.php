@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Edit {!! $site->name !!}</h4>
        </div>
        <div class="panel-body">
            {!! Form::model($site, ['route' => ['roommate.sites.update', $site->id], 'method' => 'put']) !!}
            @include('roommate.sites._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop