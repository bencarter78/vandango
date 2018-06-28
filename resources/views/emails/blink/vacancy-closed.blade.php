@extends('emails.totalpeople_email_master')

@section('content')
    <h1>Your Vacancy Has Closed</h1>

    <p>
        This is a notification to let you know that {!! $vacancy->contact->organisation->name !!}'s
        {!! $vacancy->title !!} vacancy has now closed.
    </p>

    <p>
        Using the link below you will be able to see the number of applicants for your vacancy and by clicking this
        number, you will be able to see the applicants Maths, English and ICT grades.
    </p>

    <p>
        {!! link_to_route('blink.vacancies.show', 'View Your Vacancy', $vacancy->id) !!}
    </p>

    <p>Thank you</p>
    <p>Recruitment & Engagement Team</p>
    <p><strong>Total People</strong></p>
@stop