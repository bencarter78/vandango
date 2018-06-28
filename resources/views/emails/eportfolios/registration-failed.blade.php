@extends('emails.email_master')

@section('content')
    <p>Hi</p>

    <p>
        This is to inform you that the following Applicant was not registered for a OneFile account.
    </p>

    <ul>
        <li>Applicant: {{ $applicant->name }}</li>
        <li>Sector: {{ $applicant->sector->name }}</li>
        <li>Adviser: {{ $applicant->adviser->fullName }}</li>
        <li>OneFile Centre: {{ $applicant->eportfolio->centre->name }}</li>
        <li>Reason: {{ $exception->getMessage() }}</li>
    </ul>

    <p>
        You will continue to receive this message until error is fixed or the applicant is removed from VanDango.
    </p>

    <p>
        Thanks
    </p>

    <p><strong>VanDango</strong></p>
@stop