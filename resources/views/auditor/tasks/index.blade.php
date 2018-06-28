@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>All Tasks</h4>
        </div>
        <div class="panel-body">
            <auditor-tasks-data-table
                    :tasks="{{ htmlspecialchars(json_encode($tasks), ENT_QUOTES) }}"
                    :user-id="{{ $currentUser->id }}"
                    :has-access="{{ $currentUser->hasAccess('auditorAdmin') }}"/>
        </div>
    </div>
@stop