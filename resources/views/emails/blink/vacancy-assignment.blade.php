@extends('emails.totalpeople_email_master')

@section('content')
    <h1>You have been assigned a vacancy</h1>

    <p>
        This is to let you know that you have been assigned as the Application Manager
        for {!! $vacancy->contact->organisation->name !!}'s {!! $vacancy->title !!} vacancy.
    </p>

    <p>
        {!! link_to_route('blink.vacancies.show', 'View Your Vacancy', $vacancy->id) !!}
    </p>

    <p>Thank you</p>
    <p>Recruitment & Engagement Team</p>
    <p><strong>Total People</strong></p>
@stop