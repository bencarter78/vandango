@extends('emails.email_master')

@section('content')
    <p>Hello</p>
    <p>
        We have had a message from our email system to inform us that the following email you were sending has bounced.
    </p>
    <ul>
        <li><strong>Email Address:</strong> {!! $recipient !!}</li>
        <li><strong>Service:</strong> {!! ucfirst($tag) !!}</li>
        <li><strong>Subject:</strong> {!! $title !!}</li>
        <li><strong>Sent:</strong> {!! $sent_on !!}</li>
    </ul>
    <p>
        Please amend your records for the bounced email address. Depending on how your automated emails are set up, you
        may need to do this manually.
    </p>
    <p>
        Thanks
    </p>
    <p>
        <strong>Mailbox@VanDango</strong>
    </p>
@stop