@extends('emails.totalpeople_email_master')

@section('content')
    <h1>Your Vacancy Is Live</h1>

    <p>
        This is to let you know that your {!! $vacancy->title !!} vacancy is now live on the National Apprenticeship
        Service.
    </p>

    <p>
        The Total People website pulls in the information from the National Apprenticeship website every day so you may
        see a slight delay in your vacancy appearing on our website.
    </p>

    <p>
        {!! link_to($url, 'View Your Vacancy') !!}
    </p>

    <p>Thank you</p>
    <p>Recruitment & Engagement Team</p>
    <p><strong>Total People</strong></p>
@stop