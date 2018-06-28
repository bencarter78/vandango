@extends('layouts.master')
@section('content')

    @if($assessments->count() > 0)
        <div class="panel panel-default">

            @include('partials/panels/_heading', [
                'access' => 'judiAdmin',
                'title' => $assessments->first()->sector->present()->name . ' Planned Assessments',
                'titleClass' => 'pull-left',
                'buttonText' => 'Create Assessment',
                'buttonRoute' =>  'judi.assessments.create',
                'buttonRouteParameters' =>''
            ] )


            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Staff Member</th>
                        <th>Process Type</th>
                        <th>PA</th>
                        <th>Assessment Date</th>
                        @if($currentUser->hasAccess('judiAdmin'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                    @foreach($assessments->sortBy('assessment_date') as $assessment)
                        <tr>
                            <td>{!! link_to_route('judi.assessments.user', $assessment->user->present()->name, $assessment->user_id ) !!}</td>
                            <td>{!! $assessment->process->name !!}</td>
                            <td>{!! $assessment->assessor->present()->name !!}</td>
                            <td>{!! $assessment->assessment_date->format('d/m/Y') !!}</td>
                            @if( $currentUser->hasAccess('judiAdmin') )
                                <td class="text-center">
                                    <div class="actions">
                                        <a class="btn btn-primary btn-xs" href="{!! URL::route('judi.assessments.edit', $assessment->id) !!}"><i class="fa fa-pencil"></i></a>
                                        |
                                        <a class="btn btn-danger btn-xs" role="button" data-target="#modal{!! $assessment->id !!}" data-toggle="modal"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="panel-footer">{!! $assessments->render() !!}</div>
        </div>

    @else
        <h1>Nothing to see...</h1>
        @if($currentUser->hasAccess('judiAdmin'))
            <a href="{!! URL::route('judi.assessments.create') !!}" class="button button-secondary">Create
                Assessment</a>
        @else
            <p>Keep moving, keep moving.</p>
        @endif
    @endif

@stop

@include('partials/modals/_delete', [
	'model' => $assessments,
	'title' => 'Assessment',
	'route' => 'judi.assessments.destroy'
])