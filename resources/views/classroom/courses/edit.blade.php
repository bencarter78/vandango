@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Edit Course</h4>
        </div>
        <div class="panel-body">
            <form class="form" action="{!! route('classroom.courses.update', $course->id) !!}" method="post">
                <input type="hidden" value="patch" name="_method" />
                @include('classroom.courses._form')
            </form>
        </div>
    </div>
@stop