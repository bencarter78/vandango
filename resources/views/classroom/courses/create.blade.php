@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Create Course</h4>
        </div>
        <div class="panel-body">
            <form class="form" action="{!! route('classroom.courses.store') !!}" method="post">
                {!! csrf_field() !!}
                @include('classroom.courses._form')
            </form>
        </div>
    </div>
@stop