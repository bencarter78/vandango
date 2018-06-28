@extends('emails.email_master')

@section('content')
	<p>Hi {!! $user->first_name !!}</p>
	<p>Your team is shortly to be part of the annual performance assessment cycle.</p>
	<p>Depending on your job role, assessment of initial assessment, progress review, internal quality assurance and/or teaching and learning will be carried out as part of the assessment either as a desk top review, observation or both, using the criteria set out under {!! link_to('http://10.2.70.5/intranet-new/procedures/pt8a-performance-assessment', 'procedure PT8a') !!}.</p>
	<p>You will be contacted by your Performance Assessor to make appropriate arrangements relating to performance assessment activity. Please ensure you participate fully. If you are to have an observation of teaching and learning, we have now included some tips that maybe of use to you in preparing for this.</p>
	<p>If you feel that you have been discriminated against or treated unfairly in any way during the performance assessment, you can appeal against the decision within 5 working days following {!! link_to('http://10.2.70.5/intranet-new/procedures/performance-assessment-appeals-pt8c', 'procedure PT8c') !!}.</p>
	<p>If you have any problems, please <a href="mailto:judi@totalpeople.co.uk">send us an email</a>.</p>
	<p>Thank you</p>
	<p><strong>Judi@VanDango</strong></p>
@stop