@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>My CPD</h4>
        </div>
        <div class="panel-body">
            <cpd-user-dashboard
                    :contract-year="{{ htmlspecialchars(json_encode($contractYear)) }}"
                    :user="{{ htmlspecialchars(json_encode($user)) }}"/>
        </div>
    </div>
@stop