@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a href="{!! URL::route('cpd.activities.create') !!}" class="btn btn-secondary">
                    <i class="fa fa-plus"></i> Add
                </a>
            </div>
            <h4>My CPD Activities</h4>
        </div>
        <div class="panel-body">
            <cpd-user-dashboard :contract-year="{{ htmlspecialchars(json_encode($contractYear)) }}" :user-id="{{ $currentUser->id }}" />
        </div>
    </div>
@stop