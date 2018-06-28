@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="pull-right">
                <a href="{!! URL::route('judi.processes.create') !!}" class="btn btn-secondary">
                    <i class="fa fa-plus"></i>
                    Create Process
                </a>
            </div>
            <h4>Performance Assessment Processes</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Linked Job Roles</th>
                    @if($currentUser->hasAccess('judiAdmin'))
                        <th class="text-center">Actions</th>
                    @endif
                </tr>
                </thead>
                @foreach($processes as $process)
                    <tr>
                        <td>{!! $process->name !!}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($process->roles as $role)
                                    <li>{!! $role->job_role !!}</li>
                                @endforeach
                            </ul>
                        </td>
                        @include('partials/tables/_td-actions', [ 'access' => 'judiAdmin', 'route' => 'judi.processes.edit', 'model' => $process ])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@include('partials/modals/_delete', [
	'model' => $processes,
	'title' => 'Process',
	'route' => 'judi.processes.destroy'
])
