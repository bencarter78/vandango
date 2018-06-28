@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        @include('partials.panels._head', ['title' => 'Create Site'])
        <div class="panel-body">
            {!! Form::open(['route' => 'roommate.sites.store', 'class' => 'form']) !!}
            @include('roommate.sites._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop