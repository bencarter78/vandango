@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @include('partials/panels/_heading', [
                    'access' => 'judiAdmin',
                    'title' => $sector->name . ' Performance Assessment',
                    'titleClass' => '',
                    'buttonText' => 'Create Assessment',
                    'buttonRoute' =>  'judi.assessments.create',
                    'buttonRouteParameters' => ['sector' => $sector->id]
                ] )
                <div class="panel-body spacer-bottom-x">
                    <ul class="nav nav-tabs">
                        <li class="{!! isActiveTab(Request::segment(4), 'planned') !!}">
                            <a href="{!! URL::route('judi.sectors.planned', [$sector->id]) !!}">
                                <i class="fa fa-fw fa-calendar"></i> Planned
                            </a>
                        </li>

                        <li class="{!! isActiveTab(Request::segment(4), 'submitted') !!}">
                            <a href="{!! URL::route('judi.sectors.submitted', [$sector->id]) !!}">
                                <i class="fa fa-fw fa-check"></i> Submitted
                            </a>
                        </li>

                        <li class="{!! isActiveTab(Request::segment(4), 'staff') !!}">
                            <a href="{!! URL::route('judi.sectors.staff', $sector->id) !!}">
                                <i class="fa fa-fw fa-users"></i>
                                Staff
                            </a>
                        </li>
                    </ul>
                </div>

                @if(isActiveTab(Request::segment(4), 'staff'))
                    @include('judi.partials._staff', [$users] )
                @else
                    @include('judi/partials/_assessments', ['assessments' => $assessments])
                @endif
            </div>
        </div>
    </div>
@stop