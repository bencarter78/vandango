<ul class="list-group">
    <li class="list-group-item">
        <strong>Status: </strong>
        @if($vacancy->isDeleted())
            Vacancy Deleted
        @else
            {!! $vacancy->statuses->last()->name !!}
        @endif
    </li>
    <li class="list-group-item">
        <span class="pull-right">
            <blink-vacancy-closing-date-update
                    updated-by="{!! $currentUser->id !!}"
                    url="{!! route('blink.vacancies.closing-date.update', $vacancy->id) !!}"
                    closes-on="{!! $vacancy->closes_on ? $vacancy->closes_on->format('d/m/Y') : '' !!}">
            </blink-vacancy-closing-date-update>
        </span>
        <strong>Closing Date: </strong>
        {!! isset($vacancy->closes_on) ? $vacancy->closes_on->format('d/m/Y') : '' !!}
    </li>
    <li class="list-group-item">
        <span class="pull-right">
            <blink-vacancy-ref-update
                    updated-by="{!! $currentUser->id !!}"
                    url="{!! route('blink.vacancies.ref.update', $vacancy->id) !!}"
                    nas-ref="{!! $vacancy->ref !!}">
            </blink-vacancy-ref-update>
        </span>
        <strong>NAS Ref: </strong>
        {!! $vacancy->ref or 'N/A' !!}
    </li>
    @if($vacancy->ref)
        <li class="list-group-item">
            <strong>No. Applicants: </strong>
            <ava-application-count nas-ref="{!! $vacancy->ref !!}"></ava-application-count>
        </li>
    @endif
    <li class="list-group-item">
        <strong>Submitted By:</strong>
        {!! $vacancy->submittedBy->fullName !!}
    </li>
    <li class="list-group-item">
        <span class="pull-right">
            <blink-vacancy-application-manager-update
                    updated-by="{!! $currentUser->id !!}"
                    url="{!! route('blink.vacancies.application-manager.update', $vacancy->id) !!}">
            </blink-vacancy-application-manager-update>
        </span>
        <strong>Application Manager:</strong>
        {!! $vacancy->applicationManager ? $vacancy->applicationManager->fullName : 'Pending' !!}
    </li>
    <li class="list-group-item">
        <strong>Approved By:</strong>
        @if($vacancy->approvedBy)
            {!! $vacancy->approvedBy->fullName !!}
        @elseif($vacancy->ref)
            Recruitment & Engagement Team
        @else
            Pending
        @endif
    </li>
</ul>

@if($vacancy->isPending())
    @can('update', $vacancy)
        <div class="spacer-bottom-1x">
            <blink-vacancy-approval
                    vacancy="{!! htmlspecialchars($vacancy, ENT_QUOTES) !!}"
                    action="{!! route('blink.vacancies.approval', $vacancy->id) !!}">
            </blink-vacancy-approval>
        </div>
    @endcan
@endif

<div class="spacer-top-3x spacer-bottom-1x">
    <a class="btn btn-warning btn-block text-upper" href="{!! route('blink.vacancies.duplicate', $vacancy->id) !!}">
        Clone
    </a>
</div>

@unless($vacancy->deleted_at)
    @can('delete', $vacancy)
        <blink-vacancy-remove
                is-draft="{!! $vacancy->isDraft() !!}"
                vacancy-id="{!! $vacancy->id !!}"
                user-id="{!! $currentUser->id !!}"
                previous-url="{!! url()->previous() !!}">
        </blink-vacancy-remove>
    @endcan
@endunless