@extends('emails.email_master')

@section('content')
    <p>Hi</p>
    <p>
        This is just to let you know that the following Subcontractors have their Performance Assessment Due within the
        next 3 months.
    </p>

    <ul>
        @foreach($subcontractors as $subby)
            <li>{!! $subby->name !!}</li>
        @endforeach
    </ul>

    <p>Thank you</p>
    <p><strong>Judi@VanDango</strong></p>
@stop