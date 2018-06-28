@extends('emails.email_master')

@section('content')
    <h1>You Have Been Assigned To An Enquiry</h1>

    <p>Hello {!! $user->first_name !!}</p>

    <p>The following enquiry has been assigned to you, you are now the Account Manager for this enquiry.</p>

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
            <strong>Initial Enquiry Note: </strong> {!! $enquiry->activities->first()->note or 'N/A' !!}
        </li>
        <li>
            <strong>Submitted By: </strong> {!! $enquiry->activities->first()->updatedBy->fullName !!} on {!! $enquiry->created_at->format('d/m/Y H:i:s') !!}
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