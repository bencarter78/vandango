@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>My Notifications</h4>
        </div>
        <div class="panel-body">
            <user-notifications :user-id="{{ $currentUser->id }}"/>
        </div>
    </div>
@stop
