@extends('emails.email_master')

@section('content')
    <h2>You Have Been Assigned To An Applicant</h2>

    <p>
        This is to inform you that you have been assigned as the following applicant's Training Adviser.
    </p>

    <h3>Details</h3>

    <ul>
        <li><strong>Name: </strong> {{ $applicant->name }}</li>
        <li><strong>Start Date: </strong> {{ $applicant->starting_on->format('d/m/Y') }}</li>
        <li><strong>Sector: </strong> {{ $applicant->sector->name }}</li>
        <li><strong>Type: </strong> {{ $applicant->programme_type }}</li>
    </ul>

    <p>
        {!! link_to_route('apply.applicants.index', 'My Applicants') !!}
    </p>

    <p>Thank you</p>
    <p><strong>Apply@VanDango</strong></p>
@stop