@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{!! $department->department !!} Overview</h4>
        </div>
        <div class="panel-body">
            <blink-department-user-data-table department-id="{!! $department->id !!}"></blink-department-user-data-table>
        </div>
    </div>
@stop