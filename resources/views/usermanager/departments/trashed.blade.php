@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix"><h4>Departments Trash</h4></div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Departments</th>
                    @include('partials/tables/_th-actions', [ 'access' => 'hr' ])
                </tr>
                <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td>{!! $department->department !!}</td>
                        @include('partials/tables/_td-restore', [ 'access' => 'hr', 'route' => 'departments.restore', 'model' => $department ])
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">{!! $departments->render() !!}</div>
    </div>
@stop