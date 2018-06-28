@extends('emails.email_master')

@section('content')
<h1>Probation Ended</h1>
<p>Hello {!! $user->first_name !!}</p>
<p>This is confirmation that {!! $staff->present()->name !!} has successfully completed their probation.</p>

<h3>What do you need to do?</h3>
<p>Please ensure the following:</p>
<ul>
    <li>
        The probation review document and preparation form is fully completed, signed by both yourself and
        {!! $staff->first_name !!}.
    </li>
    <li>You both retain a copy.</li>
    <li>Forward a copy to HR.</li>
</ul>

<p>Thank you</p>
<p><strong>UserManager@VanDango</strong></p>
@stop