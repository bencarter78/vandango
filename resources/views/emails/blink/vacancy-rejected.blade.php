@extends('emails.email_master')

@section('content')
    <h1>Your Vacancy Was Rejected</h1>

    <p>Hello {!! $vacancy->enquiry->owners->last()->first_name !!}</p>

    <p>The following vacancy has been rejected.</p>

    <ul class="list-unstyled">
        <li>{!! $vacancy->title !!}</li>
        <li>{!! $vacancy->framework->full_name !!}</li>
        <li>{!! $vacancy->contact->organisation->name !!}</li>
        <li>{!! $vacancy->location->present()->address !!}</li>
    </ul>

    <h3>Rejection</h3>
    <ul>
        <li>
            <strong>Rejected By: </strong> {!! $vacancy->rejected->by->fullName !!}
        </li>
        <li>
            <strong>Reason: </strong> {!! $vacancy->rejected->description !!}
        </li>
    </ul>

    <p>
        {!! link_to_route('blink.enquiries.edit', 'View Enquiry', ['id' => $vacancy->enquiry_id]) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop