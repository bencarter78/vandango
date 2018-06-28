@extends('emails.email_master')

@section('content')
<p>Hi</p>
<p>This is to let you know that the following Assessment Generation has failed with the error message of...</p>
<p style="color: red;">"{!! $error !!}"</p>
<ul>
    <li><strong>Staff Member:</strong> {!! $staff->present()->name !!}</li>
    <li><strong>Process Type:</strong> {!! $process->name !!}</li>
    <li><strong>Sector:</strong> {!! $sector->name !!}</li>
</ul>
<p>You will now need to {!! link_to_route('judi.dashboard', 'visit Judi') !!}, fix the error and manually {!! link_to_route('judi.assessments.create', 'create the assessment in Judi', ['sector' => $sector->id]) !!}.</p>
<p>Thank you</p>
<p><strong>Judi@VanDango</strong></p>
@stop