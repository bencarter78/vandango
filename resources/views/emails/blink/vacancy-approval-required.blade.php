@extends('emails.email_master')

@section('content')
    <h3>New Vacancy Submitted</h3>
    <p>Hello {!! $user->first_name !!}</p>
    <p>A new vacancy has been submitted by {!! $vacancy->submittedBy->fullName !!} and requires approval.</p>

    <p>
        Please review the vacancy below or alternatively on
        {!! link_to_route('blink.vacancies.show', 'VanDango > Blink', ['id' => $vacancy->id]) !!}.
    </p>

    <h4 style="margin-top: 50px;">Approving & Rejecting Vacancies</h4>
    <p>
        <strong>Via VanDango: </strong>
        Visit {!! link_to_route('blink.vacancies.show', 'VanDango > Blink', ['id' => $vacancy->id]) !!}
        and click the appropriate button.
    </p>
    <p>
        <strong>Via Email: </strong>
        Reply to this email with the word <strong>Approved</strong> or if you are rejecting please reply with the word
        <strong>Reject</strong> along with the reason why you are rejecting the vacancy. The Recruitment & Engagement
        Team will then complete the approval process on VanDango on your behalf.
    </p>


    <h4 style="margin-top: 50px;">Details</h4>

    <table class="table table-striped table-bordered">
        <tbody>
        <tr>
            <th style="vertical-align: top;" width="20%">Organisation</th>
            <td style="vertical-align: top; padding-bottom: 20px;">
                @if($vacancy->contact)
                    {!! $vacancy->contact->organisation->name !!}
                @endif
            </td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Location</th>
            <td style="vertical-align: top; padding-bottom: 20px;">
                @if($vacancy->location)
                    {!! $vacancy->location->address !!}
                @endif
            </td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Organisation Description</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->organisation_description !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Contact</th>
            <td style="vertical-align: top; padding-bottom: 20px;">
                @if($vacancy->contact)
                    {!! $vacancy->contact->name !!}
                @endif
            </td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Vacancy Title</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->title !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Sector</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! isset($vacancy->sector) ? $vacancy->sector->name : '' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Framework</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! isset($vacancy->framework) ? $vacancy->framework->full_name : '' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Type</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->qual_type == 0 ? 'Apprenticeship' : 'Traineeship' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Level</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->level ? $vacancy->level->name : '' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Duration</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->duration !!} months</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Wage</th>
            <td style="vertical-align: top; padding-bottom: 20px;">£{!! $vacancy->wage !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Total Hours</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->hours !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Working Week</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->working_week !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Closes On</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! isset($vacancy->closes_on) ? $vacancy->closes_on->format('d/m/Y') : '' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Interviews On</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! isset($vacancy->closes_on) ? $vacancy->interviews_on->format('d/m/Y') : '' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Starts On</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! isset($vacancy->closes_on) ? $vacancy->starts_on->format('d/m/Y') : '' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">No. Positions</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->positions_count !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Job Description</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->description !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Required Skills</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->required_skills !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Required Qualifications</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->required_qualifications !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Personal Qualities</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->personal_qualities !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Training Provided</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->training_provided !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Future Prospects</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->future_prospects !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Considerations</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->considerations !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Questions</th>
            <td style="vertical-align: top; padding-bottom: 20px;">
                <ol class="list-unstyled">
                    <li>{!! $vacancy->question_1 !!}</li>
                    <li>{!! $vacancy->question_2 !!}</li>
                </ol>
            </td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Filter Applications</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->filter_applications == 1 ? 'Yes' : 'No' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Show Company</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->is_visible == 1 ? 'Yes' : 'No' !!}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Application Route</th>
            <td style="vertical-align: top; padding-bottom: 20px;">{!! $vacancy->application_route_url or 'NAS' !!}</td>
        </tr>
        </tbody>
    </table>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop