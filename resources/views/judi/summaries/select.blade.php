@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Choose Which Report To Use' ] )
        <div class="panel-body">
            {!! Form::open([
                'route' => ['judi.summaries.select.post', $assessment->id]
                ]) !!}
            <div class="form-group">
                {!! Form::label('Report Process Type') !!}
                {!! Form::select('report_id', dropdownOptions($assessment->process->reports, 'title'), null, array('class' => 'form-control')) !!}
                {!! Form::hidden('assessment_id', $assessment->id, array('class' => 'form-control')) !!}
            </div>
            {!! Form::submit('Select', array('name' => 'submit', 'class' => 'btn btn-secondary')) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop