@extends('emails.email_master')

@section('content')
    <h2>Adviser Required For Applicant</h2>

    <p>
        {{ $applicant->submittedBy->present()->name }} has registered an applicant that has no Training Adviser
        assigned.
    </p>

    <p>You now need to assign a Training Adviser to the applicant and arrange for them to be signed up.</p>

    <h3>Details</h3>

    <ul>
        <li><strong>Name: </strong> {{ $applicant->name }}</li>
        <li><strong>Start Date: </strong> {{ $applicant->starting_on->format('d/m/Y') }}</li>
        <li><strong>Sector: </strong> {{ $applicant->sector->name }}</li>
        <li><strong>Type: </strong> {{ $applicant->programme_type }}</li>
    </ul>

    <p>
        {!! link_to_route('apply.sectors.show', 'Assign Training Adviser', [
            'id' => $applicant->sector_id,
            'programme_group' => $applicant->programme_type,
            'period' => periodFromDate($applicant->starting_on)]) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Apply@VanDango</strong></p>
@stop