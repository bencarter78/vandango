@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Edit Vacancy</h4>
                </div>

                <div class="panel-body">
                    <form method="post" action="{!! route('blink.vacancies.update', $vacancy->id) !!}" class="form">
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="enquiry_id" value="{!! old('enquiry_id', $vacancy->enquiry_id) !!}">
                        @include('blink.vacancies._partials._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop