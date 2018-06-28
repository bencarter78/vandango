@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="sub-nav panel panel-default">
                <h4>Auditor Categories</h4>
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item {!! isActiveTab(str_slug($categories->first()->name), str_slug($category->name)) !!}">
                            <a href="#{!! str_slug($category->name) !!}" data-toggle="tab">{!! $category->name !!}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="tab-content">
                    @foreach($categories as $category)
                        <div role="tabpanel"
                             class="tab-pane {!! isActiveTab(str_slug($categories->first()->name), str_slug($category->name)) !!}"
                             id="{!! str_slug($category->name) !!}">

                            @include('partials/panels/_heading', [
                                'access' => 'auditorAdmin',
                                'title' => $category->name . ' Tasks',
                                'titleClass' => '',
                                'buttonText' => 'Add Task',
                                'buttonIcon' => 'plus',
                                'buttonRoute' =>  'auditor.tasks.create',
                                'buttonRouteParameters' => [],
                                'buttonClass' => 'pull-right'
                            ] )

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Task</th>
                                        <th>Recipients</th>
                                        <th>Frequency</th>
                                        <th class="text-center">Run</th>
                                        @include('partials/tables/_th-actions', ['access' => 'auditorAdmin'])
                                    </tr>
                                    @foreach($category->tasks->sortBy('title') as $task)
                                        <tr>
                                            <td>
                                                <strong>{!! link_to_route('auditor.tasks.edit', $task->title, $task->id) !!}</strong>
                                                <p>{!! $task->description !!}</p>
                                            </td>
                                            <td>
                                                @if(strlen($task->recipients) > 100)
                                                    {!! substr($task->recipients, 0, 100) !!}...
                                                @else
                                                    {!! $task->recipients !!}
                                                @endif
                                            </td>
                                            <td>
                                                @if($task->run_frequency == '')
                                                    Draft
                                                @else
                                                    Every {!! ucfirst($task->run_frequency) !!}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <task-modal route="{!! URL::route('auditor.audit', $task->id) !!}"></task-modal>
                                            </td>
                                            @if( $currentUser->hasAccess('auditorAdmin') )
                                                <td class="text-center">
                                                    <ul class="list-inline actions">
                                                        <li>
                                                            <a class="btn btn-circle btn-primary btn-xs" name="edit" id="edit_{!! $task->id !!}" href="{!! route('auditor.tasks.edit', $task->id) !!}">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('auditor.tasks.clone.store') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                                <button class="btn btn-circle btn-warning btn-xs" role="button" name="clone" href="{{ route('auditor.tasks.clone.store', $task->id) }}">
                                                                    <i class="fa fa-copy"></i>
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a class="btn btn-circle btn-danger btn-xs" id="delete_{!! $task->id !!}" role="button" data-target="#modal{!! $task->id !!}" data-toggle="modal">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        @push('modalContent')
                            @foreach ($category->tasks as $task)
                                @include('partials/modals/_delete-single', [
                                    'model' => $task,
                                    'title' => 'Task',
                                    'route' => 'auditor.tasks.destroy'
                                ])
                            @endforeach
                        @endpush
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop