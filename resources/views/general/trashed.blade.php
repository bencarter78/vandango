@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix"><h4>{!! $title !!} Trash</h4></div>

        @if($collection->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    @foreach( $collection->first()->getAttributes() as $key => $value )
                        <th>{!! tidyFieldName($key) !!}</th>
                    @endforeach
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($collection as $item)
                    <tr>
                        @foreach( $item->getAttributes() as $key => $value )
                            <td>{!! $value !!}</td>
                        @endforeach
                        <td>
                            <div class="actions">
                                <a class="btn btn-secondary btn-block btn-xs" href="{!! URL::route($route, $item->id) !!}">Restore</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">{!! $collection->render() !!}</div>
        @else
            <div class="panel-body"><p>Trash is empty!</p></div>
        @endif
    </div>
@stop