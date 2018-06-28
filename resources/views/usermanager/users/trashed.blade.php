@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix"><h4>Users Trash</h4></div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Staff Member</th>
                    <th>Departments</th>
                    <th>Sectors</th>
                    @include('partials/tables/_th-actions', [ 'access' => 'hr' ])
                </tr>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <span class="user">{!! $user->present()->name !!}</span>
                        </td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($user->departments as $dept)
                                    <li>{!! $dept->department !!}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($user->sectors as $sector)
                                    <li>{!! $sector->name !!}</li>
                                @endforeach
                            </ul>
                        </td>
                        @include('partials/tables/_td-restore', [ 'access' => 'hr', 'route' => 'users.restore', 'model' => $user ])
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">{!! $users->render() !!}</div>
    </div>
@stop