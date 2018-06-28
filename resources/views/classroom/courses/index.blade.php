@extends('layouts.master')

@section('content')
    <div class="panel panel-default">

        @include('partials/panels/_heading', [
            'access' => '',
            'title' => 'All Courses',
            'titleClass' => '',
            'buttonText' => 'Add',
            'buttonRoute' =>  'classroom.courses.create',
            'buttonRouteParameters' => ''
        ] )

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 50%;">Name</th>
                        <th>Type</th>
                        <th>Requirement</th>
                        @if($currentUser->hasAccess('classroomAdmin'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                    @foreach($courses as $course)
                        <tr>
                            <td>
                                <strong>{!! $course->name !!}</strong> <br/>
                                {!! $course->description !!}
                            </td>
                            <td>{!! $course->type->name !!}</td>
                            <td>
                                @if($course->is_mandatory == true)
                                    Mandatory for
                                    @if($course->roles->count() == 0)
                                        all staff
                                    @else
                                        {!! implode(', ', $course->roles->pluck('job_role')->all()) !!}
                                    @endif
                                @else
                                    Optional
                                @endif
                            </td>
                            @if($currentUser->hasAccess('classroomAdmin'))
                                <td class="text-center">
                                    <ul class="list-inline actions">
                                        <li>
                                            <a class="btn btn-circle btn-primary btn-sm" href="{!! URL::route('classroom.courses.edit', $course->id) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn btn-circle btn-danger btn-sm" role="button" data-target="#modal{!! $course->id !!}" data-toggle="modal">
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
        <div class="panel-footer">
            {!! $courses->render() !!}
        </div>
    </div>
@stop

@include('partials/modals/_delete', [
	'model' => $courses,
	'title' => 'Course',
	'route' => 'classroom.courses.destroy'
])