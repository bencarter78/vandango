@extends('emails.email_master')

@section('content')
    <h2>Unmatched Applicants</h2>

    <p>
        The following applicants have you recorded as their Training Adviser, have not been matched on PICS and have now
        gone over 6 weeks past their projected start date.
    </p>

    <p>Please use the link below to search for the applicants and...</p>

    <ul>
        <li>Ensure their information is correct and update where necessary (spelling mistakes are quite common)</li>
        <li>If the start is not going to happen please select 'REMOVE' and a reason why</li>
    </ul>

    <h3>Unmatched Applicants</h3>

    <ul>
        @foreach($applicants as $app)
            <li>
                {!! $app->name !!}
                @if($app->organisation_name)
                    ({!! $app->organisation_name !!})
                @endif
                - {!! $app->starting_on->format('d/m/Y') !!}
            </li>
        @endforeach
    </ul>

    <p>
        If you are confident that the applicant has been signed up and is still not matched with their information,
        please contact Programme Admin.
    </p>

    <p>
        {!! link_to_route('apply.applicants.unmatched', 'Your Unmatched Applicants') !!}
    </p>

    <p>Thank you</p>
    <p><strong>Apply@VanDango</strong></p>
@stop