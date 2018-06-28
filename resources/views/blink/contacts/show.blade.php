@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a href="{!! route('blink.enquiries.create') !!}" class="btn btn-secondary">
                    <i class="fa fa-plus"></i> Add
                </a>
            </div>
            <h4>
                {!! $contact->name !!}
                @if($contact->organisation)
                    <small>
                        <i class="fa fa-building-o"></i>
                        <a href="{!! route('blink.organisations.show', $contact->organisation->id) !!}" class="is-link">
                            {!! $contact->organisation->name !!}
                        </a>
                    </small>
                @endif
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item list-group-heading">
                            <span class="pull-right">
                                <blink-update-contact
                                        url="{!! route('blink.contacts.update', $contact->id) !!}"
                                        updated-by="{!! $currentUser->id !!}"
                                        contact="{!! htmlspecialchars(json_encode($contact), ENT_QUOTES) !!}">
                                </blink-update-contact>
                            </span>
                            <h4>Details</h4>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-fw fa-user"></i> {!! $contact->name !!}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-fw fa-phone"></i> {!! $contact->tel !!}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-fw fa-envelope"></i> {!! $contact->email !!}
                        </li>
                    </ul>
                </div>

                <div class="col-md-9">
                    <h4 class="spacer-bottom-2x">Enquiries</h4>
                    @include('blink.partials._enquiry-listing', ['enquiries' => $contact->allEnquiries])
                </div>
            </div>
        </div>
        <div class="panel-footer">

        </div>
    </div>
@stop