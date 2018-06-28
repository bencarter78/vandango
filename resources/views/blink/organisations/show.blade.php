@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @if(!$organisation->datastore_ref)
                <div class="pull-right">
                    <blink-organisation-pics-sync organisation-id="{!! $organisation->id !!}"></blink-organisation-pics-sync>
                </div>
            @endif

            <h4>
                <i class="fa fa-building-o"></i>
                {!! $organisation->name !!}
            </h4>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-3">
                    @include('blink.organisations._partials._details')
                </div>

                <div class="col-md-9">
                    @include('blink.organisations._partials._tabs-nav')
                    @include('blink.organisations._partials._tabs-content')
                </div>

            </div>
        </div>
    </div>
@stop