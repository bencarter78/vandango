@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="pull-right">
                @include('partials.auth.buttons._add', [ 'permission' => 'hr', 'route' => 'roles.create', 'label' => 'Add Role' ])
            </div>
            <h4>All Job Roles</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Job Role</th>
                    @include('partials/tables/_th-actions', [ 'access' => 'hr' ])
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{!! link_to_route( 'roles.show', $role->job_role, [$role->id] ) !!}</td>
                        @include('partials/tables/_td-actions', [ 'access' => 'hr', 'route' => 'roles.edit', 'model' => $role ])
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            {!! $roles->render() !!}
        </div>
    </div>
@stop

@include('partials/modals/_delete', [
	'model' => $roles,
	'title' => 'Role',
	'route' => 'roles.destroy'
])
