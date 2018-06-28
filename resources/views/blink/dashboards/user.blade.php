@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <a href="{!! URL::route('blink.enquiries.create') !!}" class="btn btn-secondary">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </div>
                    <h4>Enquiries Assigned To {!! $currentUser->fullName !!}</h4>
                </div>

                <div class="panel-body">
                    <div class="has-actions">
                        <blink-enquiry-data-table
                                endpoint="{!! route('api.blink.user.enquiries', $currentUser->id) !!}"
                                has-access="true">
                        </blink-enquiry-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop