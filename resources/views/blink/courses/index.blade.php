@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [
            'access' => 'auditorAdmin',
            'title' => 'Pricing Catalogue',
            'titleClass' => '',
            'buttonText' => 'Add',
            'buttonRoute' =>  'blink.courses.create',
            'buttonRouteParameters' => [],
            'buttonClass' => 'pull-right'
        ] )

        <div class="panel-body">
            <blink-courses-data-table
                    :has-access="{{ $currentUser->hasAccess('blinkAdmin') || $currentUser->isDepartmentManager() }}"
                    endpoint="{{ route('api.blink.courses.index') }}"/>
        </div>
    </div>
@stop