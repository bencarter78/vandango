@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <course-register
                course-id="{!! $timetable->id !!}"
                has-access="{!! $currentUser->hasAccess('classroom') || $currentUser->hasAccess('classroomAdmin') || $currentUser->isManager() !!}"
                is-admin="{!! $currentUser->hasAccess('classroomAdmin') !!}"
                current-user-id="{!! $currentUser->id !!}"
        ></course-register>
    </div>
@stop