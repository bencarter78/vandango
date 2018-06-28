@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Create Enquiry</h4>
        </div>
        <div class="panel-body">
            <form action="{!! route('blink.enquiries.store') !!}" class="form" method="post">
                {!! csrf_field() !!}

                <blink-enquiry-add
                        contact_id="{!! old('contact_id') !!}"
                        contact_name="{!! old('search')['contact_id'] !!}"
                        contact_tel="{!! old('contact_tel') !!}"
                        contact_email="{!! old('contact_email') !!}"
                        organisation_id="{!! old('organisation_id') !!}"
                        organisation_name="{!! old('search')['organisation_id'] !!}"
                        organisation_location="{!! old('organisation_location') !!}"
                        organisation_size="{!! old('organisation_size') !!}"
                        options="{!! htmlspecialchars(json_encode($referrers)) !!}"
                        referrer-id="{!! old('referrer_id') !!}"
                        note="{!! old('note') !!}">
                </blink-enquiry-add>
                {!! Form::submit('Save', ['name' => 'submit', 'class' => 'btn btn-secondary btn-lg']) !!}
            </form>
        </div>
    </div>
@stop