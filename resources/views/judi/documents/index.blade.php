@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [
            'access' => 'judiAdmin',
            'title' => 'All Documents',
            'titleClass' => '',
            'buttonText' => 'Create Document',
            'buttonRoute' =>  'judi.documents.create',
            'buttonRouteParameters' => ''
        ] )

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Procedure Number</th>
                    @include('partials/tables/_th-actions', ['access' => 'judiAdmin'])
                </tr>
                </thead>
                @foreach($documents as $document)
                    <tr>
                        <td>{!! link_to($document->url, $document->title) !!}</td>
                        <td>{!! $document->number !!}</td>
                        @include('partials/tables/_td-actions', [ 'route' => 'judi.documents.edit', 'model' => $document, 'access' => 'judiAdmin' ])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@include('partials/modals/_delete', [
	'model' => $documents,
	'title' => 'Document',
	'route' => 'judi.documents.destroy'
])