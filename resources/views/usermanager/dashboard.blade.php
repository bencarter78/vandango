@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">UserManager Dashboard</h3></div>

        <div class="panel-body">
            <ul class="nav nav-tabs spacer-bottom-2x">
                <li class="active"><a href="#recruits" data-toggle="tab">Recruits</a></li>
                <li><a href="#leavers" data-toggle="tab">Leavers</a></li>
                <li><a href="#unassigned" data-toggle="tab">Unassigned Role</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="recruits">
                    @include('usermanager/partials/_users', ['users' => $users])
                </div>

                <div class="tab-pane" id="leavers">
                    @include('usermanager/partials/_users', ['users' => $leavers])
                </div>

                <div class="tab-pane" id="unassigned">
                    @include('usermanager/partials/_users', ['users' => $unassignedRole])
                </div>
            </div>
        </div>
    </div>

@stop