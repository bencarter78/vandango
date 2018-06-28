@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [
            'access' => 'surveyHoundAdmin',
            'title' => 'All Surveys',
            'titleClass' => '',
            'buttonText' => 'Create',
            'buttonIcon' => 'plus',
            'buttonRoute' =>  'surveyhound.create',
            'buttonRouteParameters' => null,
            'buttonClass' => 'pull-right'
        ] )
        @if($surveys->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Frequency</th>
                        <th class="text-center">Send</th>
                        @include('partials.tables._th-actions', ['access' => 'surveyHoundAdmin'])
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($surveys as $survey)
                        <tr>
                            <td>{!! $survey->title !!}</td>
                            <td>{!! $survey->description !!}</td>
                            <td>
                                @if($survey->frequency == '')
                                    Draft
                                @else
                                    Every {!! ucfirst($survey->frequency) !!}
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-success btn-circle" title="Send now" data-target="#modal_run_{!! $survey->id !!}" data-toggle="modal">
                                    <i class="fa fa-paper-plane"></i>
                                </a>
                            </td>
                            @include('partials.tables._td-actions', [ 'route' => 'surveyhound.edit', 'model' => $survey, 'access' => 'surveyHoundAdmin' ])
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        @else
            <div class="panel-body">
                <h4>We've looked everywhere but we can't find any surveys.</h4>
                <p>Want
                    to {!! link_to_route('surveyhound.create', 'create one', null, ['class' => 'text-success']) !!}
                    ?</p>
            </div>
        @endif
    </div>

@stop

@include('partials/modals/_delete', [
	'model' => $surveys,
	'title' => 'Survey',
	'route' => 'surveyhound.destroy'
])

@if( $surveys->count() > 0 )
    @push('modalContent')
        @foreach ($surveys as $survey)
            <div id="modal_run_{!! $survey->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                            <h3 class="modal-title" id="myModalLabel">
                                Send the survey?
                            </h3>
                        </div>
                        <div class="modal-body">
                            <p>
                                You are about to send the survey. Please confirm if
                                you wish to proceed.
                            </p>
                        </div>
                        <div class="modal-footer text-left">
                            <a class="spacing-top btn btn-lg btn-success" href="{!! URL::route('surveyhound.send', $survey->id) !!}">
                                Send
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endpush
@endif