@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-3 col-lg-2">
            @include('forum.partials._sidebar')
        </div>

        <div class="col-md-9 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Create a Channel</h4>
                </div>
                <div class="panel-body">
                    <forum-channel-add :user-id="{{ $currentUser->id }}" />
                </div>
            </div>
        </div>
    </div>
@stop