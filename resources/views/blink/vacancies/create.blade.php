@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Create Vacancy
                    </h4>
                </div>

                <div class="panel-body">
                    <form method="post" action="{!! route('blink.vacancies.store') !!}" class="form">
                        <input type="hidden" name="enquiry_id" value="{!! request('id') !!}">
                        @include('blink.vacancies._partials._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop