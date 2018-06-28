@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="pull-right">
                @include('partials.auth.buttons._add', [ 'permission' => 'hr', 'route' => 'departments.create', 'label' => 'Add Department' ])
            </div>
            <h4>All Departments</h4>
        </div>
        <div class="panel-body">
            <div class="has-actions">
                <department-search
                        has-access="{!! $currentUser->hasAccess('hr') !!}"
                        csrf-token="{!! csrf_token() !!}"
                ></department-search>
            </div>
        </div>
    </div>
@stop