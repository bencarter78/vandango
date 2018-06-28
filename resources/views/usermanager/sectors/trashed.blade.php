@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix"><h4>Sectors Trash</h4></div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Sectors</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                @foreach ($sectors as $sector)
                    <tr>
                        <td>{!! $sector->name !!} [{!! $sector->code !!}]</td>
                        @include('partials/tables/_td-restore', [ 'access' => 'hr', 'route' => 'sectors.restore', 'model' => $sector ])
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">{!! $sectors->render() !!}</div>
    </div>
@stop