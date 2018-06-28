@extends('emails.email_master')

@section('content')
    <h2>Paperwork Issue Found</h2>

    <p>Hello</p>

    <p>
        Your paperwork submission for {!! $applicant->name !!} has been flagged by {!! $user->fullName !!} as having an
        issue. Please contact Programme Administration ASAP to discuss.
    </p>

    <h4>Issue Description</h4>

    <p>{{ $data['description'] }}</p>

    <p>Thank you</p>
    <p><strong>Apply@VanDango</strong></p>
@stop