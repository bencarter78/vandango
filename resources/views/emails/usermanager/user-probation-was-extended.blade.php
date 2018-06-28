@extends('emails.email_master')

@section('content')
<h1>Probation Extension</h1>
<p>Hello {!! $user->first_name !!}</p>
<p>
    This is confirmation that {!! $staff->present()->name !!}'s probation has been extended until
    {!! $staff->meta->probation_end_date->format('d/m/Y') !!}.
</p>

<h3>What do you need to do?</h3>
<p>Please ensure the following:</p>
<ul>
    <li>
        The probation review document and preparation form is fully completed, signed by both yourself and
        {!! $staff->first_name !!}.
    </li>
    <li>Development plans are clearly documented.</li>
    <li>The review date is planned in on your calendar.</li>
    <li>You both retain a copy.</li>
    <li>Forward a copy to HR.</li>
</ul>

<p>Thank you</p>
<p><strong>UserManager@VanDango</strong></p>
@stop