<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#history" aria-controls="history" role="tab" data-toggle="tab">Activity</a>
    </li>
    <li role="presentation">
        <a href="#opportunities" aria-controls="opportunities" role="tab" data-toggle="tab">
            Opportunities
            @if($enquiry->opportunities->where('deleted_at', null)->sum->quantity > 0)
                <span class="badge badge-primary">
                    {!! $enquiry->opportunities->where('deleted_at', null)->sum->quantity !!}
                </span>
            @endif
        </a>
    </li>
    <li role="presentation">
        <a href="#vacancies" aria-controls="vacancies" role="tab" data-toggle="tab">
            Vacancies
            @if($enquiry->vacancies->where('deleted_at', null)->reject->rejected->count() > 0)
                <span class="badge badge-primary">
                    {!! $enquiry->vacancies->where('deleted_at', null)->reject->rejected->count() !!}
                </span>
            @endif
        </a>
    </li>
    <li role="presentation">
        <a href="#applicants" aria-controls="applicants" role="tab" data-toggle="tab">
            <i class="fa fa-users"></i> Identified
            @if($enquiry->applicants->count() > 0)
                <span class="badge badge-primary">
                    {!! $enquiry->applicants->count() !!}
                </span>
            @endif
        </a>
    </li>
    @if($enquiry->owners->count() > 0)
        <li class="pull-right">
            <blink-enquiry-actions
                    statuses="{!! htmlspecialchars(json_encode($statuses)) !!}"
                    conclusions="{!! htmlspecialchars(json_encode($conclusions)) !!}"
                    status-id="{!! $enquiry->statuses->last()->id !!}"
                    enquiry-data="{!! htmlspecialchars(json_encode($enquiry)) !!}"
                    unhired-applicants-data="{!! htmlspecialchars(json_encode($enquiry->unhiredApplicants())) !!}"
                    user-id="{!! $currentUser->id !!}"
                    :is-completed="{{ json_encode($enquiry->isCompleted()) }}">
            </blink-enquiry-actions>
        </li>
    @endif
</ul>