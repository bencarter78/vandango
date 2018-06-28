<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Application Form</title>
    <style>
        html, body {
            font-family: "Arial", sans-serif;
            font-size: 12px;
        }

        section.section-main {
            clear: both;
        }

        section.section-sub {
            margin-bottom: 20px;
        }

        section > h1 {
            font-size: 22px;
        }

        section > h2 {
            font-size: 18px;
            border-bottom: 1px solid #e4e4e4;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        section.section-header > h3 {
            font-size: 14px;
            border-left: 5px solid #3389d7;
            padding-left: 5px;
            padding-bottom: 0;
            margin: 0 auto 30px;
        }

        .spacer-bottom-3x {
            margin-bottom: 30px;
        }

        .spacer-bottom-5x {
            margin-bottom: 50px;
        }

        .title-reset {
            line-height: 120%;
        }

        .no-break {
            page-break-inside: avoid;
        }

        dl {
            width: 100%;
        }

        dt {
            float: left;
            font-weight: bold;
            text-align: left;
            width: 10%;
            clear: both;
            line-height: 200%;
        }

        dd {
            float: left;
            line-height: 200%;
        }

        table.personal_details {
            width: 100%;
            max-width: 100%;
            margin-bottom: 30px;
        }

        .table {
            background-color: #fff;
        }

        p {
            line-height: 150%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <section class="section-header">
            <h1>{!! $application->vacancy->title !!}</h1>
            <h3>
                {!! ucwords($application->vacancy->organisation->name) !!} -
                {{ $application->vacancy->location->town }}, {{ $application->vacancy->location->post_code }}
            </h3>
        </section>

        <section class="section-main">
            <h2>
                {!! ucwords($application->applicant->first_name) !!}
                {!! ucwords($application->applicant->surname) !!}
            </h2>
            <table class="personal_details">
                <tr>
                    <th>Address:</th>
                    <td>
                        {{ collect($application->applicant->address)->last()->add1 }}
                        {{ collect($application->applicant->address)->last()->add2 }}
                        {{ collect($application->applicant->address)->last()->add3 }}
                        {{ collect($application->applicant->address)->last()->town }}
                        {{ collect($application->applicant->address)->last()->county }}
                        {{ collect($application->applicant->address)->last()->post_code }}
                    </td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{!! $application->applicant->email !!}</td>
                </tr>
                <tr>
                    <th>Tel:</th>
                    <td>{!! $application->applicant->tel !!}</td>
                </tr>
            </table>
        </section>

        <section class="section-main">
            <h2>Education</h2>
            <section class="section-sub no-break">
                <h3 class="">Schools/Colleges</h3>
                <ul class="list-unstyled">
                    @foreach($application->applicant->schools as $school)
                        <li>
                            {!! ucwords($school->name) !!}
                            ({!! $school->attended_from !!}-{!! $school->attended_to !!})
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="section-sub">
                <h3 class="">Qualifications</h3>
                @if($qualifications->count() > 0)
                    <table class="table">
                        <tr>
                            <th>Subject</th>
                            <th>Qualification</th>
                            <th>Grade</th>
                            <th>Year</th>
                        </tr>
                        @foreach($qualifications as $qualification)
                            <tr>
                                <td>{!! ucwords($qualification->subject) !!}</td>
                                <td>{!! $qualification->qualification !!}</td>
                                <td>{!! strtoupper($qualification->grade) !!}</td>
                                <td>{!! $qualification->year !!}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p>No Information provided.</p>
                @endif
            </section>

            @if(collect($application->applicant->training)->count() > 0)
                <section class="section-sub">
                    <h3 class="">Training</h3>
                    <table class="table">
                        <tr>
                            <th>Institution</th>
                            <th>Qualification/Course</th>
                            <th>Year</th>
                        </tr>
                        @foreach($application->applicant->training as $t)
                            <tr>
                                <td>{!! ucwords($t->institution) !!}</td>
                                <td>{!! ucwords($t->title) !!}</td>
                                <td>
                                    {!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $t->trained_from)->format('m/Y') !!} -
                                    {!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $t->trained_to)->format('m/Y') !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </section>
            @endif
        </section>

        <section class="section-main">
            <h2>Work History</h2>
            @if($workHistory->count() > 0)
                @foreach($workHistory as $history)
                    <h4 class="title-reset">
                        {!! ucwords($history->organisation) !!}
                        <small>
                            ({!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $history->worked_from)->format('M Y') !!}
                            -
                            @if($history->worked_to == null)
                                Present)
                            @else
                                {!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $history->worked_to)->format('M Y') !!}
                                )
                            @endif
                        </small>
                    </h4>
                    <p class="spacer-bottom-3x">{!! $history->description !!}</p>
                @endforeach
            @else
                <p>Applicant has no work experience / No information provided.</p>
            @endif
        </section>

        <section class="section-main">
            <h2>About</h2>
            <h4 class="title-reset">{!! $about->strengths->question !!}</h4>
            <p class="spacer-bottom-5x">{!! $about->strengths->answer or 'No answer provided' !!}</p>

            @if($about->improvements)
                <h4 class="title-reset">{!! $about->improvements->question !!}</h4>
                <p class="spacer-bottom-5x">{!! $about->improvements->answer or 'No answer provided' !!}</p>
            @endif

            <h4 class="title-reset">{!! $about->other_hobbies->question !!}</h4>
            <p class="spacer-bottom-5x">{!! $about->other_hobbies->answer or 'No answer provided' !!}</p>
        </section>

        <section class="section-sub">
            <h3>Questions</h3>
            @foreach($about->questions as $question)
                <h4 class="title-reset">{!! $question->question !!}</h4>
                <p class="spacer-bottom-5x">{!! $question->answer !!}</p>
            @endforeach
        </section>
    </div>
</div>
</body>
</html>