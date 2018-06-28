@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @include('partials/panels/_heading', [
                    'title' => "{$assessor->present()->name} Caseload",
                ] )

                <div class="panel-body spacer-bottom-x">
                    <ul class="nav nav-tabs">
                        <li class="{!! isActiveTab(Request::segment(4), 'planned') !!}">
                            <a href="{!! URL::route('judi.assessors.planned', $assessor->id) !!}">
                                <i class="fa fa-fw fa-calendar"></i> Planned
                            </a>
                        </li>
                        <li class="{!! isActiveTab(Request::segment(4), 'submitted') !!}">
                            <a href="{!! URL::route('judi.assessors.submitted', $assessor->id) !!}">
                                <i class="fa fa-fw fa-check"></i> Submitted
                            </a>
                        </li>
                    </ul>
                </div>

                @include('judi/partials/_assessments', ['assessments' => $assessments ])
            </div>
        </div>
    </div>
@stop