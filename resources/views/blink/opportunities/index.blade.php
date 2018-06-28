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
                    <h4>Live Opportunities</h4>
                </div>

                <div class="panel-body">
                    <blink-opportunity-data-table
                            endpoint="{!! config('vandango.blink.endpoints.opportunities.index') !!}">
                    </blink-opportunity-data-table>
                </div>
            </div>
        </div>
    </div>
@stop