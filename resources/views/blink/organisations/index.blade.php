@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>All Organisations</h4>
                </div>

                <div class="panel-body">
                    <div class="has-actions">
                        <blink-organisation-data-table
                                endpoint="{!! config('vandango.blink.endpoints.organisations.index') !!}"
                                has-access="true">
                        </blink-organisation-data-table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop