@extends('emails.email_master')

@section('content')
    <p>Hi</p>

    <p>
        The following learner's email addresses does not appear to be valid. Please update this learner's record.
    </p>

    <ul>
        <li class="list-item">
            <strong>Learner:</strong> {!! trim($learner->firstname) !!} {!! trim($learner->surname) !!}
        </li>
        <li class="list-item">
            <strong>IDENT:</strong> ({!! trim($learner->ident) !!})
        </li>
        <li class="list-item">
            <strong>Email:</strong> {!! trim($learner->lnr_email) !!}
        </li>
    </ul>

    <p>Thanks</p>
    <p><strong>Auditor @ VanDango</strong></p>
@stop