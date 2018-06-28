@extends('emails.email_master')

@section('content')
    <h1>Enquiry Requires Updating</h1>

    <p>Hello {!! $enquiry->owners->last()->first_name !!}</p>

    <p>
        The following enquiry is assigned to you and is still showing as
        <strong>Stage 2 - Unqualified</strong>, {!! $daysSinceCreated !!} days after the enquiry was created.
    </p>

    <p>
        Please provide an update to the enquiry and progress it's status including adding any opportunities, vacancies
        or named starts where applicable.
    </p>

    <h3>Details</h3>
    <ul class="list-unstyled">
        <li>
            <strong>Organisation: </strong> {!! $enquiry->contact->organisation->name !!}
        </li>
        <li>
            <strong>Location: </strong> {!! $enquiry->location !!}
        </li>
        <li>
            <strong>Contact: </strong> {!! $enquiry->contact->name !!}
        </li>
        <li>
            <strong>Tel: </strong> {!! $enquiry->contact->tel or 'N/A' !!}
        </li>
        <li>
            <strong>Email: </strong> {!! $enquiry->contact->email or 'N/A' !!}
        </li>
        <li>
            <strong>Submitted By: </strong> {!! $enquiry->activities->first()->updatedBy->fullName !!}
            on {!! $enquiry->created_at->format('d/m/Y H:i:s') !!}
        </li>
    </ul>

    <h3>Enquiry Activity</h3>
    @foreach($enquiry->activities as $activity)
        <p>
            {!! $activity->note !!} <br>
            <small>
                <strong>
                    {!! isset($activity->updatedBy) ? $activity->updatedBy->present()->name : 'VanDango Blink' !!}
                </strong>
                on {!! $activity->created_at->format('d/m/Y H:i') !!}
            </small>
        </p>
    @endforeach

    <p>
        {!! link_to_route('blink.enquiries.edit', 'View Enquiry', ['id' => $enquiry->id]) !!}
    </p>

    <p>Thank you</p>
    <p><strong>Blink@VanDango</strong></p>
@stop