@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                {!! $department->department !!} Department
                <small>Staff Members</small>
            </h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Sectors</th>
                    <th>Roles</th>
                </tr>
                <tbody>
                @foreach($department->users->sortBy('first_name') as $user)
                    <tr>
                        <td>{!! link_to_route('account.show', $user->present()->name, $user->username) !!}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach( $user->sectors as $key => $sector)
                                    <li>{!! $sector->name !!}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach( $user->roles as $key => $role)
                                    <li>{!! $role->job_role !!}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop