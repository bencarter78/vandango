<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Applicant</th>
            <th>DOB</th>
            <th class="text-center">Age</th>
            <th>Type</th>
            <th>Sector</th>
            <th>Start Due</th>
            <th>Signed Up</th>
            <th>Adviser</th>
            <th>Submitted By</th>
        </tr>
        </thead>
        <tbody>
        @foreach($applicants as $applicant)
            <tr>
                <td>
                    {!! $applicant->name !!}
                    @if($applicant->hasBeenHired())
                        <span class="badge badge-success">Hired</span>
                    @endif
                </td>
                <td>{!! $applicant->dob ? $applicant->dob->format('d/m/Y') : 'N/A' !!}</td>
                <td class="text-center">{!! $applicant->dob ? $applicant->dob->age : '' !!}</td>
                <td>{!! $applicant->programme_type !!}</td>
                <td>{!! $applicant->sector->present()->sector !!}</td>
                <td>{!! $applicant->starting_on->format('d/m/Y') !!}</td>
                <td>
                    @if($applicant->started_on)
                        {!! $applicant->started_on->format('d/m/Y') !!}
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
                <td>{!! $applicant->submittedBy->present()->name !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>