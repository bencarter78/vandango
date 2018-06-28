@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @include('partials/panels/_heading', [
                    'access' => 'judiAdmin',
                    'title' => "{$user->present()->name} Assessments",
                    'buttonText' => 'Create Assessment',
                    'buttonRoute' =>  'judi.assessments.create',
                    'buttonRouteParameters' => ['user' => $user->id]
                ] )

                <div class="panel-body spacer-bottom-x">
                    <ul class="nav nav-tabs">
                        <li class="{!! isActiveTab(Request::segment(5), 'planned') !!}">
                            <a href="{!! URL::route('judi.assessments.user.planned', $user->id) !!}">
                                <i class="fa fa-fw fa-calendar"></i> Planned
                            </a>
                        </li>

                        <li class="{!! isActiveTab(Request::segment(5), 'submitted') !!}">
                            <a href="{!! URL::route('judi.assessments.user.submitted', $user->id) !!}">
                                <i class="fa fa-fw fa-check"></i> Submitted
                            </a>
                        </li>

                        <li class="{!! isActiveTab(Request::segment(5), 'settings') !!}">
                            <a href="{!! URL::route('judi.assessments.user.settings.edit', $user->id) !!}">
                                <i class="fa fa-fw fa-cog"></i> Settings
                            </a>
                        </li>

                        @if ( $currentUser->hasAccess('admin') || isLineManager( $currentUser->id, $user ) )
                            <li class="pull-right">
                                <a href="{!! URL::route('account.edit', $user->username) !!}">
                                    <i class="fa fa-fw fa-pencil"></i> Edit
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                @if(Request::segment(5) === 'settings')
                    @include('judi/assessments/partials/_user-settings', ['settings' => $user->assessmentSettings])
                @else
                    @include('judi/partials/_assessments', ['assessments' => $assessments])
                @endif
            </div>
        </div>
    </div>
    </div>
@stop