@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>Overall Grade</h4></div>
                <div class="panel-body text-center">
                    <span class="grade">{!! $summary->grade->name !!}</span>
                    <div>
                        {!! gradeConvertToStars($summary->grade->name) !!}
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <strong>{!! $summary->assessment_date->format('jS F Y') !!}</strong></div>
            </div>

            @foreach($summary->criteria as $criteria)
                @if( $criteria->name === config('vandango.judi.criteria.contentGradeName'))
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><h4>Content Grade</h4></div>
                        <div class="panel-body text-center">
                            <span class="grade">{!! gradeConverter( $criteria->pivot->grade_id ) !!}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                @include('partials/panels/_heading', [
                    'title' => $summary->assessment->user->present()->name . ': ' . $summary->report->title . ' Summary',
                    'titleClass' => '',
                    'buttonText' => 'Linked Document',
                    'buttonIcon' => 'download',
                    'buttonRoute' =>  'judi.summaries.documentation',
                    'buttonRouteParameters' => $summary->id,
                    'buttonClass' => 'pull-right',
                    'access' => 'judi'
                ] )

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Criteria</th>
                            <th>Grade</th>
                        </tr>
                        @foreach($summary->criteria as $criteria)
                            @if( $criteria->name != config('vandango.judi.criteria.contentGradeName') )
                                <tr>
                                    <td>{!! $criteria->name !!}</td>
                                    <td>{!! gradeConverter( $criteria->pivot->grade_id ) !!}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop