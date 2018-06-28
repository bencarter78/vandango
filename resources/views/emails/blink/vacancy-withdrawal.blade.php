@extends('emails.email_master')

@section('content')
    <h1>Vacancy Requires Withdrawing</h1>

    <p>Please close the following vacancy on NAS and update the vacancy on VanDango Blink.</p>

    <ul class="list-unstyled">
        <li>
            <strong>Ref:</strong>
            {!! $vacancy->ref !!}
        </li>
        <li>
            <strong>Title:</strong>
            {!! $vacancy->title !!}
        </li>
        <li>
            <strong>Organisation:</strong>
            {!! $vacancy->contact->organisation->name !!}
        </li>
        <li>
            <strong>Framework:</strong>
            {!! $vacancy->framework->full_name !!}
        </li>
        <li>
            <strong>Location:</strong>
            {!! $vacancy->location->present()->address !!}
        </li>
    </ul>

    <p>
        {!! link_to_route('blink.enquiries.edit', 'View Enquiry', ['id' => $vacancy->enquiry_id]) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop