@extends('emails.email_master')

@section('content')
    <h2>Exported {!! ucwords($programme) !!} Apply Applicants</h2>
    <p>Please find attached an updated list of {!! ucwords($programme) !!} Apply Applicants.</p>
    <p>Thank you</p>
    <p><strong>Apply@VanDango</strong></p>
@stop