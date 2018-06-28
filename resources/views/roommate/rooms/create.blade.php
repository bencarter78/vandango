@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        @include('partials.panels._head', ['title' => 'Create Room'])
        <div class="panel-body">
            {!! Form::open(['route' => 'roommate.rooms.store', 'class' => 'form']) !!}
            @include('roommate.rooms._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop