@extends('emails.email_master')

@section('content')
    <p>Hello {!! $user->first_name !!}</p>

    <p>
        The following enquiry is marked as <strong>Qualified</strong>, however it has no opportunities or named starts
        recorded against it. Please update your enquiry, adding opportunities or named starts where applicable.
    </p>

    <p>
        If you do not add opportunities or named starts to your enquiry, your pipeline activity will not be recorded
        against your sector.
    </p>

    <h4>Details</h4>
    <ul>
        <li>
            <strong>Organisation:</strong> {!! $enquiry->contact->organisation->name !!}
        </li>
        <li>
            <strong>Enquiry Date:</strong> {!! $enquiry->created_at->format('d/m/Y') !!}
        </li>
    </ul>

    <p>
        {!! link_to_route('blink.enquiries.edit', 'View Enquiry', ['id' => $enquiry->id]) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop