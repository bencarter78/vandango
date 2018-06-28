@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>All Contacts</h4>
                </div>

                <div class="panel-body">
                    <div class="has-actions">
                        <blink-contact-data-table
                                endpoint="{!! config('vandango.blink.endpoints.contacts.index') !!}"
                                has-access="true">
                        </blink-contact-data-table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop