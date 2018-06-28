@extends('layouts.master')
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            {!! $sector->present()->sector !!} Sector
            <small>Staff Members</small>
        </h4>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Name</th>
                <th>Roles</th>
            </tr>
            <tbody>
                @foreach($sector->users as $user)
                    <tr>
                        <td>{!! link_to_route('account.show', $user->present()->name, $user->username) !!}</td>
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