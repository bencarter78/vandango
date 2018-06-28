@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Create CPD Activity</h4>
        </div>
        <div class="panel-body">
            <cpd-activity :user-id="{{ $currentUser->id }}" />
        </div>
    </div>
@stop