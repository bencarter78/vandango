@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h4>{!! $sector->name !!} [{!! $sector->code !!}]</h4></div>
        {!! Form::model($sector, array('route' => array('judi.sectors.update', $sector->id), 'method' => 'put') ) !!}
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('PA Month') !!}
                {!! Form::select('month', dropdownOptions(getMonths()), isset($sector->schedule->month) ? $sector->schedule->month : '', array('class' => 'form-control')) !!}
                @include('partials/forms/_error', [ 'field' => 'month' ])
            </div>

        </div>
        <div class="panel-footer">
            {!! Form::submit('Update', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
        {!! Form::close() !!}
    </div>

@stop