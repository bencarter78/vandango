@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix"><h4>{!! $title !!} Trash</h4></div>

        @if($results->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        @foreach( $results->first()->getAttributes() as $key => $value )
                            <th>{!! tidyFieldName($key) !!}</th>
                        @endforeach
                        <th class="text-center">Actions</th>
                    </tr>
                    <tbody>
                    @foreach ($results as $item)
                        <tr>
                            @foreach( $item->getAttributes() as $key => $value )
                                <td>{!! $value !!}</td>
                            @endforeach
                            <td class="text-center">
                                <div class="actions">
                                    <a class="btn btn-secondary btn-circle btn-xs"
                                       href="{!! URL::route('usermanager.restore', [Request::segment(3), $item->id]) !!}"
                                       title="Restore"
                                    >
                                        <i class="fa fa-undo"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">{!! $results->render() !!}</div>
        @else
            <div class="panel-body"><p>Trash is empty!</p></div>
        @endif
    </div>
@stop