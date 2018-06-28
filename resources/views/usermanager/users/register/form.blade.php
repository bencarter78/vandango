@extends('layouts.master')
@section('content')
    {!! Form::open( ['route' => 'register.store', 'class' => 'form-horizontal' ]) !!}
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Account Registration</h4></div>
        <div class="panel-body">

            <div class="form-group">
                {!! Form::label('email', 'Email', [ 'class' => 'col-md-2 control-label' ] ) !!}
                <div class="col-md-10">
                    {!! Form::email('email', old('email'), array('class' => 'form-control')) !!}
                    @include('partials/forms/_error', [ 'field' => 'email' ] )
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('first_name', 'First Name', [ 'class' => 'col-md-2 control-label' ] ) !!}
                <div class="col-md-10">
                    {!! Form::text('first_name', old('first_name'), array('class' => 'form-control')) !!}
                    @include('partials/forms/_error', [ 'field' => 'first_name' ] )
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('surname', 'Surname', [ 'class' => 'col-md-2 control-label' ] ) !!}
                <div class="col-md-10">
                    {!! Form::text('surname', old('surname'), array('class' => 'form-control')) !!}
                    @include('partials/forms/_error', [ 'field' => 'surname' ] )
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('start_date', 'Start Date', [ 'class' => 'col-md-2 control-label' ] ) !!}
                <div class="col-md-10">
                    <datepicker field-name="start_date" min-date="null" value="{!! old('start_date') !!}"></datepicker>
                    @include('partials/forms/_error', [ 'field' => 'start_date' ] )
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2" style="padding-left: 15px;">
                    {!! Form::hidden('group_id', 3) !!}
                    {!! Form::submit('Create', array('name' => 'register', 'class' => 'btn btn-secondary')) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
