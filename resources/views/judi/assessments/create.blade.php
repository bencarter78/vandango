@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="">Create Assessment</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'judi.assessments.store', 'class' => '')) !!}
                    <div class="form-group">
                        {!! Form::label('Staff Member') !!}
                        {!! Form::select('user_id', dropdownOptions($staff, 'name'), $user, array('class' => 'form-control')) !!}
                        @include('partials/forms/_error', [ 'field' => 'user_id' ])
                    </div>

                    <div class="form-group">
                        {!! Form::label('Sector') !!}
                        {!! Form::select('sector_id', dropdownOptions($sectors, 'name'), Request::has('sector') ? Request::get('sector') : null, array('class' => 'form-control')) !!}
                        @include('partials/forms/_error', [ 'field' => 'sector_id' ])
                    </div>

                    <div class="form-group">
                        {!! Form::label('Process') !!}
                        {!! Form::select('process_id', dropdownOptions($processes, 'name'), null, array('class' => 'form-control')) !!}
                        @include('partials/forms/_error', [ 'field' => 'process_id' ])
                    </div>

                    @include('judi/assessments/partials/_form')
                    {!! Form::hidden('ruleset', 'create') !!}
                    {!! Form::submit('Create', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop