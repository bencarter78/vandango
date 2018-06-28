@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h4>{!! $assessor->present()->name !!}</h4></div>
        {!! Form::model($assessor, array('route' => array('judi.assessors.update', $assessor->id), 'method' => 'put') ) !!}

        <div class="table-responsive">
            <table class="table table-striped">
                @foreach($processes as $process)
                    <tr>
                        <td width="5%">{!! Form::checkbox('process_id[]', $process->id, checkboxState($process->id, $assessor->processes()->pluck('process_id')->all())) !!}</td>
                        <td>{!! $process->name !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="panel-footer">
            {!! Form::submit('Update', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
        {!! Form::close() !!}
    </div>

@stop