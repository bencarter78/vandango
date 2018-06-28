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
                    <h4>All Live Enquiries</h4>
                </div>

                <div class="panel-body">
                    <div class="has-actions">
                        <blink-enquiry-search/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop