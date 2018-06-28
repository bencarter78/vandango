@extends('emails.email_master')

@section('content')
    <p>
        Hello, great news!
    </p>

    <p>
        The following applicant has been added to an enquiry you have links with.
    </p>

    <h3>Details</h3>

    <ul>
        <li><strong>Name: </strong> {{ $applicant->name }}</li>
        <li><strong>Start Date: </strong> {{ $applicant->starting_on->format('d/m/Y') }}</li>
        <li><strong>Sector: </strong> {{ $applicant->sector->name }}</li>
        <li><strong>Type: </strong> {{ $applicant->programme_type }}</li>
    </ul>

    <p>
        {!! link_to_route('blink.enquiries.edit', 'View Enquiry', $applicant->enquiry_id) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop