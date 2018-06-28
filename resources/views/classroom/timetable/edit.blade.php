@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Update Scheduled Course</h4>
        </div>
        <div class="panel-body">
            <form class="form" action="{!! route('classroom.timetable.update', $timetable->id) !!}" method="post">
                <input type="hidden" value="patch" name="_method" />
                @include('classroom.timetable.partials._form')
            </form>
        </div>
    </div>
@stop