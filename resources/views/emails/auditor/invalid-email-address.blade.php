@extends('emails.email_master')

@section('content')
    <p>Hello</p>
    <p>
        Auditor attempted to send an email to the following email, however it is not a valid email address.
    </p>
    <ul>
        <li><strong>Email Address:</strong> {!! $email !!}</li>
        <li><strong>Subject:</strong> {!! $task !!}</li>
    </ul>
    <p>
        Please amend your records for the invalid email address.
    </p>
    <p>
        Thanks
    </p>
    <p>
        <strong>Auditor@VanDango</strong>
    </p>
@stop