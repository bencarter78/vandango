@extends('emails.totalpeople_email_master')

@section('content')
    <p>Hi {!! $learner->first_name !!},</p>

    <p>Please see below the key code for your Salonability Online account.</p>

    <p><strong>Key Code: </strong> {!! $learner->key !!}</p>

    <p>
        To access Salonability Online, please click on the link below and follow the instructions for “New Student
        Registration”.
    </p>

    <p><a href="https://www.artist-access.co.uk">www.artist-access.co.uk</a></p>

    <p>If you should have any issues, please contact Total People Ltd on 01606 734000.</p>

    <p>Kind regards</p>

    <p><strong>Total People</strong></p>
@stop