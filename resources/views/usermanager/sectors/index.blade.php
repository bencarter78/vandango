@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="pull-right">
                @include('partials.auth.buttons._add', [ 'permission' => 'hr', 'route' => 'sectors.create', 'label' => 'Add Sector' ])
            </div>
            <h4>All Sectors</h4>
        </div>

        <div class="panel-body">
            <div class="has-actions">
                <sector-search
                        has-access="{!! $currentUser->hasAccess('hr') !!}"
                        csrf-token="{!! csrf_token() !!}"
                ></sector-search>
            </div>
        </div>
    </div>
@stop
