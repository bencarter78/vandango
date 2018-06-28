@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{!! $user->present()->name !!} Timetable</h4>
        </div>
        @include('classroom.partials._timetable-user')
    </div>
@stop