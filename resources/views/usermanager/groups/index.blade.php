@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h4>All Groups</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>{!! link_to_route( 'groups.show', $group->name, [$group->id] ) !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop