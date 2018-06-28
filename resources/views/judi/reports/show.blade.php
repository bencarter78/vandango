@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => $report->title . ' Process Report' ] )

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Criteria</th>
                </tr>
                @foreach($report->criteria as $criteria)
                    <tr>
                        <td>{!! $criteria->name !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop