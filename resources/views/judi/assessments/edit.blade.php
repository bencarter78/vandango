@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Edit {!! $assessment->user->present()->name !!}'s {!! $assessment->process->name !!} Assessment
                    </h4>
                </div>
                <div class="panel-body">
                    {!! Form::model($assessment, array('route' => array('judi.assessments.update', $assessment->id), 'method' => 'put') ) !!}
                    @include('judi/assessments/partials/_form')
                    {!! Form::hidden('ruleset', 'update') !!}
                    {!! Form::submit('Update', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop