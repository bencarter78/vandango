@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="clearfix">
                <div class="pull-right">
                    <small class="text-secondary">
                        <i class="fa fa-circle"></i>
                        {!! ucfirst($enquiry->statuses->last()->name) !!}
                    </small>
                </div>

                {!! $enquiry->contact->name !!}

                @if($enquiry->contact->organisation)
                    <small>
                        <i class="fa fa-building-o"></i>
                        <a href="{!! route('blink.organisations.show', $enquiry->contact->organisation->id) !!}">
                            <span class="text-primary">
                                {!! $enquiry->contact->organisation->name !!}
                            </span>
                        </a>

                        @if($enquiry->contact->organisation->enquiries->count() > 1)
                            <span class="spacer-left-1x text-danger">
                                <i class="fa fa-flag"></i>
                                Has {!! $enquiry->contact->organisation->enquiries->count() - 1 !!}
                                other live {!! str_plural('enquiry', $enquiry->contact->organisation->enquiries->count() - 1) !!}
                            </span>
                        @endif
                    </small>
                @endif
            </h4>
        </div>

        <div class="panel-body">
            <div class="row">

                <div class="col-md-3">
                    @include('blink.enquiries.partials._overview')
                </div>

                <div class="col-md-9">
                    @if($enquiry->owners->count() == 0)
                        <div class="alert alert-info">
                            <i class="fa fa-warning"></i> <strong>No Account Manager assigned</strong>
                            <p class="spacer-top-1x">
                                If you are dealing with this enquiry, please assign yourself as the Account Manager.
                                Please note, you can't add an opportunity/vacancy/applicant without first assigning an
                                Account Manager.
                            </p>
                        </div>
                    @endif
                    @include('blink.enquiries.partials._tabs-nav')
                    <div class="tab-content padding-top-3x">
                        @include('blink.enquiries.partials._tabs-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop