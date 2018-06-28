@extends('emails.email_master')

@section('content')
    <h1>Vacancy Closing Date Updated</h1>

    <p>
        This is to let you know that the following vacancy has had it's closing date changed. Please make any necessary
        updates to this vacancy.
    </p>

    <ul>
        <li><strong>Ref:</strong> {!! $vacancy->ref !!}</li>
        <li><strong>Title:</strong> {!! $vacancy->title !!}</li>
        <li><strong>Organisation:</strong> {!! $vacancy->contact->organisation->name !!}</li>
        <li><strong>New Closing Date:</strong> {!! $vacancy->closes_on->format('d/m/Y') !!}</li>
    </ul>

    <p>
        {!! link_to_route('blink.vacancies.show', 'View Your Vacancy', $vacancy->id) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop