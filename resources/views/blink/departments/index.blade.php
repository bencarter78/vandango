@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>All Departments</h4>
        </div>
        <div class="panel-body">
            <blink-department-data-table></blink-department-data-table>
        </div>
    </div>
@stop