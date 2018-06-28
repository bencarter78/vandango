@if($assessments->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Staff Member</th>
                <th>Process Type</th>
                <th>PA</th>
                <th>Grade</th>
                <th>
                    @if($assessments->first()->deleted_at)
                        Assessment Date
                    @else
                        Required By
                    @endif
                </th>
                <th class="text-center">Summary</th>
                @if($currentUser->hasAccess('judiAdmin') || $currentUser->isSectorManager($assessments->first()->sector->name))
                    @if($assessments->first()->deleted_at == null)
                        <th class="text-center">Actions</th>
                    @endif
                @endif
            </tr>
            @foreach($assessments as $assessment)
                @if($assessment->user)
                    <tr>
                        <td>
                            {!! link_to_route('judi.assessments.user.planned', $assessment->user->present()->name, $assessment->user_id ) !!}
                            {!! $assessment->user->meta->present()->onProbation !!}<br>
                            <a href="{!! URL::route('judi.sectors.show', $assessment->sector->id) !!}">
                                <small>{!! $assessment->sector->name !!}</small>
                            </a>
                        </td>
                        <td>
                            @if($assessment->process)
                                {!! $assessment->process->name !!}

                                @if($assessment->is_reassessment == true)
                                    <label class="label label-danger">Re-assessment</label>
                                @endif

                                {!! getAssessmentProcessType($assessment->user->assessmentSettings, $assessment->process->id) !!}
                                @if($currentUser->hasAccess('judiAdmin') && ! $assessments->first()->deleted_at)
                                    <br/>
                                    <small>
                                        <strong>{!! $assessment->lastGrade($assessment->user_id, $assessment->process_id) !!}</strong>
                                    </small>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($assessment->assessor)
                                {!! $assessment->assessor->present()->name !!}
                            @endif
                        </td>

                        @if( $assessment->summary && $assessment->summary->grade )
                            <td>{!! $assessment->summary->grade->name !!} </td>
                        @else
                            <td>Pending</td>
                        @endif

                        <td>
                            @if( $assessment->summary && $assessment->summary->assessment_date)
                                {!! $assessment->summary->assessment_date->format('d/m/Y') !!}
                            @else
                                {!! $assessment->assessment_date->format('d/m/Y') !!}
                            @endif
                        </td>

                        <td class="text-center">
                            @if( $currentUser->hasAccess('judiPa') )
                                @if(! isset($assessment->summary))
                                    <a href="{!! URL::route('judi.summaries.select', $assessment->id) !!}" class="btn btn-secondary btn-sm btn-circle">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                @endif
                            @endif

                            @if(isset($assessment->summary) && $currentUser->hasAccess('judiPa'))
                                @if($assessment->deleted_at == null || ($assessment->deleted_at != null && $currentUser->hasAccess('judiAdmin')) )
                                    <a href="{!! URL::route('judi.summaries.edit', $assessment->summary->id) !!}" class="btn btn-primary btn-sm btn-circle">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                @endif
                            @endif

                            @if ( $assessment->deleted_at != null)
                                <a href="{!! URL::route('judi.summaries.show', $assessment->summary->id) !!}" class="btn btn-warning btn-sm btn-circle">
                                    <i class="fa fa-search-plus"></i>
                                </a>
                            @endif
                        </td>

                        @if( $currentUser->hasAccess('judiAdmin') || $currentUser->isSectorManager($assessments->first()->sector->name) )
                            @if($assessment->deleted_at == null)
                                <td class="text-center">
                                    <div class="actions">
                                        @if( $currentUser->hasAccess('judiAdmin') )
                                            <a class="btn btn-circle btn-primary btn-sm" href="{!! URL::route('judi.assessments.edit', $assessment->id) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-circle btn-danger btn-sm" role="button" data-target="#modal{!! $assessment->id !!}" data-toggle="modal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            @endif
                        @endif
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    <div class="panel-footer">{!! $assessments->render() !!}</div>
@else
    <div class="panel-body">
        <p>No assessments found.</p>
    </div>
@endif

@include('judi/assessments/partials/_delete')