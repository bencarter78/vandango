@extends('emails.email_master')

@section('content')
<h1>Your Appraisal Is Due</h1>
<p>Hello {!! $user->first_name !!}</p>
<p>This is confirmation that your appraisal is due by {!! $user->meta->appraisal_date->format('d/m/Y') !!}.</p>
<p>
    Please click on the link below where you can find the Preparation Form (PT8 FM1) which will need to be completed and
    submitted to your line manager prior to your appraisal.
</p>
<p>
    <a href="http://10.2.70.5/intranet-new/procedures/performance-management-individual-pt8/">
        PT08 – Performance Management Individual
    </a>
</p>
<p>If not already, your manager will contact you to arrange a date for your appraisal.</p>
<p>If you have any questions please ask your manager or HR.</p>
<p>Thank you</p>

<p><strong>UserManager@VanDango</strong></p>
@stop