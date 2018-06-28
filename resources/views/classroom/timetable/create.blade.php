@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Create Scheduled Course</h4>
        </div>
        <div class="panel-body">
            <form class="form" action="{!! route('classroom.timetable.store') !!}" method="post">
                {!! csrf_field() !!}
                @include('classroom.timetable.partials._form')
            </form>
        </div>
    </div>
@stop