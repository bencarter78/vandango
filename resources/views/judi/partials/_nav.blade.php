<li><a href="{!! URL::to('judi') !!}"><i class="fa fa-fw fa-gavel"></i> Judi</a></li>
@if($currentUser->hasAccess('judiAdmin'))
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Set Up</a>
        <ul class="dropdown-menu">
            <li class="dropdown-header">Processes</li>
            <li><a href="{!! URL::route('judi.processes.index') !!}"><i class="fa fa-fw fa-list"></i> All Processes</a>
            </li>
            <li><a href="{!! URL::route('judi.processes.create') !!}"><i class="fa fa-fw fa-plus-circle"></i> Create
                    Process</a></li>
            <li><a href="{!! URL::route('judi.processes.trashed') !!}"><i class="fa fa-fw fa-trash"></i> Trashed
                    Processes</a></li>

            <li class="divider"></li>
            <li class="dropdown-header">Grades</li>
            <li><a href="{!! URL::route('judi.grades.index') !!}"><i class="fa fa-fw fa-list"></i> All Grades</a></li>
            <li><a href="{!! URL::route('judi.grades.create') !!}"><i class="fa fa-fw fa-plus-circle"></i> Create Grade</a>
            </li>
            <li><a href="{!! URL::route('judi.grades.trashed') !!}"><i class="fa fa-fw fa-trash"></i> Trashed Grades</a>
            </li>

            <li class="divider"></li>
            <li class="dropdown-header">Criteria</li>
            <li><a href="{!! URL::route('judi.criteria.index') !!}"><i class="fa fa-fw fa-list"></i> All Criteria</a>
            </li>
            <li><a href="{!! URL::route('judi.criteria.create') !!}"><i class="fa fa-fw fa-plus-circle"></i> Create
                    Criteria</a></li>
            <li><a href="{!! URL::route('judi.criteria.trashed') !!}"><i class="fa fa-fw fa-trash"></i> Trashed Criteria</a>
            </li>

            <li class="divider"></li>
            <li class="dropdown-header">Process Reports</li>
            <li><a href="{!! URL::route('judi.reports.index') !!}"><i class="fa fa-fw fa-list"></i> All Process Reports</a>
            </li>
            <li><a href="{!! URL::route('judi.reports.create') !!}"><i class="fa fa-fw fa-plus-circle"></i> Create
                    Process Report</a></li>
            <li><a href="{!! URL::route('judi.reports.trashed') !!}"><i class="fa fa-fw fa-trash"></i> Trashed Process
                    Reports</a></li>

            <li class="divider"></li>
            <li class="dropdown-header">Cancellation Reasons</li>
            <li><a href="{!! URL::route('judi.cancellations.index') !!}"><i class="fa fa-fw fa-list"></i> All
                    Cancellation Reasons</a></li>
            <li><a href="{!! URL::route('judi.cancellations.create') !!}"><i class="fa fa-fw fa-plus-circle"></i> Create
                    Cancellation Reason</a></li>
            <li><a href="{!! URL::route('judi.cancellations.trashed') !!}"><i class="fa fa-fw fa-trash"></i> Trashed
                    Cancellation Reasons</a></li>

            <li class="divider"></li>
            <li class="dropdown-header">Documents</li>
            <li><a href="{!! URL::route('judi.documents.index') !!}"><i class="fa fa-fw fa-list"></i> All Documents</a>
            </li>
            <li><a href="{!! URL::route('judi.documents.create') !!}"><i class="fa fa-fw fa-plus-circle"></i> Create
                    Document</a></li>
            <li><a href="{!! URL::route('judi.documents.trashed') !!}"><i class="fa fa-fw fa-trash"></i> Trashed
                    Documents</a></li>
        </ul>
    </li>
@endif

@if($currentUser->hasRole('Performance Assessor'))
    <li><a href="{!! URL::route('judi.assessors.show', $currentUser->id) !!}">My Assessments</a></li>
@endif

@if($currentUser->hasAccess('judiAdmin') )
    <li><a href="{!! URL::route('judi.assessors.index') !!}">Assessors</a></li>
@endif

@if($currentUser->hasAccess('judiAdmin') || $currentUser->hasAccess('judiSM'))
    <li><a href="{!! URL::route('judi.sectors.index') !!}">Sectors</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Analysis</a>
        <ul class="dropdown-menu">
            <li>{!! link_to_route('judi.analysis.summaries', "Summaries") !!}</li>
            <li>{!! link_to_route('judi.analysis.criteria', "Criteria") !!}</li>
        </ul>
    </li>
@endif

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Documentation</a>
    <ul class="dropdown-menu">
        @foreach($documents as $document)
            <li>{!! link_to($document->url, "{$document->title} ({$document->number})") !!}</li>
        @endforeach
    </ul>
</li>