@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Edit {!! $room->name !!} - {{ $room->site->name }}, {{ $room->site->location->town }}</h4>
        </div>
        <div class="panel-body">
            {!! Form::model($room, ['route' => ['roommate.rooms.update', $room->id], 'method' => 'put']) !!}
            @include('roommate.rooms._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop