@extends('layouts.master')

@section('content')
    <div class="table-responsive has-actions">
        <timetable-data-table :has-access="{!! $currentUser->hasAccess('classroomAdmin') !!}"/>
    </div>
@stop