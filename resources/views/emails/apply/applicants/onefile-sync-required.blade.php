@extends('emails.email_master')

@section('content')
    <p>Hello</p>

    <p>The following applicant was successfully matched on PICS and has a OneFile account that requires syncing.</p>

    <ul>
        <li><strong>Name:</strong> {{ $applicant->name }}</li>
        <li><strong>IDENT:</strong> {{ $applicant->episode_ident }}</li>
        <li><strong>Sector:</strong> {{ $applicant->sector->name }}</li>
        <li><strong>OneFile ID:</strong> {{ $applicant->eportfolio->ref }}</li>
    </ul>

    <p>Thank you</p>
    <p><strong>Apply@VanDango</strong></p>
@stop