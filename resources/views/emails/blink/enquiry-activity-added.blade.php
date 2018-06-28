@extends('emails.email_master')

@section('content')
    <h1>New Enquiry Activity</h1>

    <p>Hello {!! $enquiry->owners->last()->first_name !!}</p>

    <p>The following activity has been added to your enquiry.</p>

    <h3>Details</h3>
    <ul class="list-unstyled">
        <li>
            <strong>Organisation: </strong> {!! $enquiry->contact->organisation->name !!}
        </li>
        <li>
            <strong>New Activity: </strong> {!! $enquiry->activities->last()->note !!}
        </li>
        <li>
            <strong>Who: </strong> {!! $enquiry->activities->last()->updatedBy->fullName !!}
        </li>
    </ul>

    <p>
        {!! link_to_route('blink.enquiries.edit', 'View Enquiry', ['id' => $enquiry->id]) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop