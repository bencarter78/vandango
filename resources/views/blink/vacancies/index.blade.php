@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>All Vacancies</h4>
                </div>

                <div class="panel-body">
                    <div class="has-actions">
                        <blink-vacancy-data-table
                                draft-status="{!! config('vandango.blink.statuses.vacancy-saved') !!}"
                                has-access="{!! $currentUser->hasAccess('blinkAdmin') !!}"
                                endpoint="{!! config('vandango.blink.endpoints.vacancies.index') !!}">
                        </blink-vacancy-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop