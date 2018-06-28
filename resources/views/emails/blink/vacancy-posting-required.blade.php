@extends('emails.email_master')

@section('content')
    <h1>New Vacancy Submitted</h1>

    <p>Hello</p>

    <p>A new vacancy has been approved and needs submitting to NAS.</p>

    <ul class="list-unstyled">
        <li>{!! $vacancy->title !!}</li>
        <li>{!! $vacancy->framework->full_name !!}</li>
        <li>{!! $vacancy->contact->organisation->name !!}</li>
        <li>{!! $vacancy->location->present()->address !!}</li>
    </ul>

    <p>
        {!! link_to_route('blink.vacancies.show', 'View Vacancy', ['id' => $vacancy->id]) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop