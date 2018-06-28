@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix"><h4>Roles Trash</h4></div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td><span class="user">{!! $role->job_role !!}</span></td>
                        @include('partials/tables/_td-restore', [ 'access' => 'hr', 'route' => 'roles.restore', 'model' => $role ])
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">{!! $roles->render() !!}</div>
    </div>
@stop