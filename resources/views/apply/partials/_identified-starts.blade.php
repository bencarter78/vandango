<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Applicant</th>
            <th>DOB</th>
            <th class="text-center">Age</th>
            <th>Type</th>
            <th>Sector</th>
            <th>Qual Plan</th>
            <th>Organisation</th>
            <th>Start Date</th>
            <th>Adviser</th>
            <th>Submitted By</th>
            <th class="text-center">Enquiry</th>
        </tr>
        </thead>
        <tbody>
        @foreach($applicants as $applicant)
            <tr>
                <td>{!! $applicant->name !!}</td>
                <td>{!! $applicant->dob ? $applicant->dob->format('d/m/Y') : 'N/A' !!}</td>
                <td class="text-center">{!! $applicant->dob ? $applicant->dob->age : '' !!}</td>
                <td>{!! $applicant->programme_type !!}</td>
                <td>{!! $applicant->sector ? $applicant->sector->present()->sector : '' !!}</td>
                <td>{!! isset($applicant->qualificationPlan) ? $applicant->qualificationPlan->description : '' !!}</td>
                <td>
                    @if($applicant->enquiry_id)
                        {{ $applicant->enquiry->contact->organisation->name }}
                    @else
                        {!! $applicant->organisation_name !!}
                    @endif
                </td>
                <td>
                    @if($applicant->started_on)
                        {!! $applicant->started_on->format('d/m/Y') !!}
                        <i class="fa fa-check-square text-success"></i>
                    @elseif($applicant->starting_on)
                        {!! $applicant->starting_on->format('d/m/Y') !!}
                        <i class="fa fa-square-o"></i>
                    @else

                    @endif
                </td>
                <td>
                    @if($applicant->adviser_id)
                        {!! $applicant->adviser->present()->name !!}
                    @else
                        @can('assignAdviser', $applicant)
                            <apply-assign-adviser applicant-id="{!! $applicant->id !!}"></apply-assign-adviser>
                        @endcan
                    @endif
                </td>
                <td>{!! $applicant->submittedBy ? $applicant->submittedBy->present()->name : '' !!}</td>
                <td class="text-center">
                    @if($applicant->enquiry_id)
                        <a href="{!! route('blink.enquiries.edit', $applicant->enquiry_id) !!}" class="is-link text-upper">
                            <small>View</small>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>