<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tbody>
        <tr>
            <th width="20%">Organisation</th>
            <td>
                @if($vacancy->contact)
                    <a href="{!! route('blink.organisations.show', $vacancy->contact->organisation_id) !!}" class="is-link">
                        {!! $vacancy->contact->organisation->name !!}
                    </a>
                    <a href="{{ route('blink.enquiries.edit', $vacancy->enquiry_id) }}" class="is-link">
                        <small>(View Enquiry)</small>
                    </a>
                @endif
            </td>
        </tr>
        <tr>
            <th>Location</th>
            <td>
                @if($vacancy->location)
                    {!! $vacancy->location->address !!}
                @endif
            </td>
        </tr>
        <tr>
            <th>Organisation Description</th>
            <td>{!! $vacancy->organisation_description !!}</td>
        </tr>
        <tr>
            <th>Contact</th>
            <td>
                @if($vacancy->contact)
                    <a href="{!! route('blink.contacts.show', $vacancy->contact_id) !!}" class="is-link">
                        {!! $vacancy->contact->name !!}
                    </a>
                @endif
            </td>
        </tr>
        <tr>
            <th>Title</th>
            <td>{!! $vacancy->title !!}</td>
        </tr>
        <tr>
            <th>Sector</th>
            <td>{!! isset($vacancy->sector) ? $vacancy->sector->name : '' !!}</td>
        </tr>
        <tr>
            <th>Framework</th>
            <td>{!! isset($vacancy->framework) ? $vacancy->framework->full_name : '' !!}</td>
        </tr>
        <tr>
            <th>Type</th>
            <td>{!! $vacancy->qual_type == 0 ? 'Apprenticeship' : 'Traineeship' !!}</td>
        </tr>
        <tr>
            <th>Level</th>
            <td>{!! $vacancy->level ? $vacancy->level->name : '' !!}</td>
        </tr>
        <tr>
            <th>Duration</th>
            <td>{!! $vacancy->duration !!} months</td>
        </tr>
        <tr>
            <th>Wage</th>
            <td>£{!! $vacancy->wage !!}</td>
        </tr>
        <tr>
            <th>Total Hours</th>
            <td>{!! $vacancy->hours !!}</td>
        </tr>
        <tr>
            <th>Working Week</th>
            <td>{!! $vacancy->working_week !!}</td>
        </tr>
        <tr>
            <th>Closes On</th>
            <td>{!! isset($vacancy->closes_on) ? $vacancy->closes_on->format('d/m/Y') : '' !!}</td>
        </tr>
        <tr>
            <th>Interviews On</th>
            <td>{!! isset($vacancy->closes_on) ? $vacancy->interviews_on->format('d/m/Y') : '' !!}</td>
        </tr>
        <tr>
            <th>Starts On</th>
            <td>{!! isset($vacancy->closes_on) ? $vacancy->starts_on->format('d/m/Y') : '' !!}</td>
        </tr>
        <tr>
            <th>No. Positions</th>
            <td>{!! $vacancy->positions_count !!}</td>
        </tr>
        <tr>
            <th>Job Description</th>
            <td>{!! $vacancy->description !!}</td>
        </tr>
        <tr>
            <th>Required Skills</th>
            <td>{!! $vacancy->required_skills !!}</td>
        </tr>
        <tr>
            <th>Required Qualifications</th>
            <td>{!! $vacancy->required_qualifications !!}</td>
        </tr>
        <tr>
            <th>Personal Qualities</th>
            <td>{!! $vacancy->personal_qualities !!}</td>
        </tr>
        <tr>
            <th>Training Provided</th>
            <td>{!! $vacancy->training_provided !!}</td>
        </tr>
        <tr>
            <th>Future Prospects</th>
            <td>{!! $vacancy->future_prospects !!}</td>
        </tr>
        <tr>
            <th>Considerations</th>
            <td>{!! $vacancy->considerations !!}</td>
        </tr>
        <tr>
            <th>Questions</th>
            <td>
                <ol class="list-unstyled">
                    <li>{!! $vacancy->question_1 !!}</li>
                    <li>{!! $vacancy->question_2 !!}</li>
                </ol>
            </td>
        </tr>
        <tr>
            <th>Filter Applications</th>
            <td>{!! $vacancy->filter_applications == 1 ? 'Yes' : 'No' !!}</td>
        </tr>
        <tr>
            <th>Show Company</th>
            <td>{!! $vacancy->is_visible == 1 ? 'Yes' : 'No' !!}</td>
        </tr>
        <tr>
            <th>Application Route</th>
            <td>{!! $vacancy->application_route_url or 'NAS' !!}</td>
        </tr>
        </tbody>
    </table>
</div>