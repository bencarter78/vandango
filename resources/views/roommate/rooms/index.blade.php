@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        @include('partials.panels._head', [
            'title' => 'All Rooms',
            'button' => ['access' => 'roommate','route' => route('roommate.rooms.create')]
        ])

        <div class="panel-body">
            <div class="has-actions">
                <rooms-data-table has-access="{!! $currentUser->hasAccess('roommate') !!}"></rooms-data-table>
            </div>
        </div>
    </div>
@stop