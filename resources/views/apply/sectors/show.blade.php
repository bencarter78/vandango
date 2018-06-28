@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                {!! $sector->present()->sector !!}

                @if(isset($applicants))
                    @include('apply.sectors.partials._sector-panel-heading')
                @endif
                @if(isset($opportunities))
                    @include('apply.sectors.partials._opportunities-panel-heading')
                @endif
            </h4>
        </div>
        <div class="panel-body">
            @if(isset($applicants))
                <div class="row spacer-bottom-2x">
                    <div class="col-md-4">
                        @include('apply.partials._filter', ['route' => route('apply.sectors.show', ['id' => request()->segment(3)])])
                    </div>
                </div>
                @if($applicants->count() > 0)
                    @include('apply.partials._identified-starts')
                @else
                    <p>No applicants have been logged for this period.</p>
                @endif
            @endif

            @if(isset($opportunities))
                @if($opportunities->count() > 0)
                    @include('apply.partials._opportunities')
                @else
                    <p>No opportunities have been logged for this period.</p>
                @endif
            @endif
        </div>
    </div>
@stop