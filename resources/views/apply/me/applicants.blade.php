@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [
            'title' => 'Your Applicant Submissions',
            'buttonText' => 'Add',
            'buttonRoute' =>  'apply.applicants.create',
        ] )

        @if($applicants->count() > 0)
            @include('apply.partials._identified-starts')
        @else
            <div class="panel-body">
                <p>You have not submitted an applicant yet.</p>
            </div>
        @endif
    </div>
@stop
