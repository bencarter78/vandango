@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Edit CPD Activity</h4>
        </div>
        <div class="panel-body">
            <cpd-activity :user-id="{{ $currentUser->id }}" :activity-id="{{ request()->segment(3) }}" />
        </div>
    </div>
@stop