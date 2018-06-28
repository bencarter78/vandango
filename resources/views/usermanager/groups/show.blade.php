@extends('layouts.master')
@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>{!! $users->count() !!} {!! $group->name !!} Staff</h4>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                </tr>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{!! link_to_route('account.show', $user->present()->name, $user->username) !!}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach( $user->departments as $department)
                                    <li>{!! $department->department !!}</li>
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