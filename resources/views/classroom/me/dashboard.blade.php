@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>My Courses</h4>
        </div>
        @include('classroom.partials._timetable-user')
    </div>
    </div>
@stop