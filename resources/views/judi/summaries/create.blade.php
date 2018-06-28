@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @include('partials/panels/_heading', [ 'title' => "{$report->title} for {$assessment->user->present()->name}" ] )
                <div class="panel-body">
                    {!! Form::open(['route' => 'judi.summaries.store', 'enctype' => 'multipart/form-data', 'files'=> true ]) !!}
                    @include('judi/summaries/partials/_form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop