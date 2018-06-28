@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix"><h4>Cancellations Trash</h4></div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                @foreach ($cancellations as $cancellation)
                    <tr>
                        <td>{!! $cancellation->type !!}</td>
                        @include('partials/tables/_td-restore', [ 'access' => 'judiAdmin', 'route' => 'judi.cancellations.restore', 'model' => $cancellation ])
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">{!! $cancellations->render() !!}</div>
    </div>
@stop