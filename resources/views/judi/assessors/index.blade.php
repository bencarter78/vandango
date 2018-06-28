@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h4>Performance Assessors</h4></div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Name</th>
                    <th class="text-center">Caseload</th>
                    <th>Department</th>
                    <th>Sector</th>
                    <th>Processes</th>
                    @if($currentUser->hasAccess('judiAdmin'))
                        <th class="text-center">Actions</th>
                    @endif
                </tr>
                @foreach($assessors as $assessor)
                    <tr>
                        <td>{!! link_to_route('judi.assessors.show', $assessor->present()->name, $assessor->id, ['class' => 'button button-primary']) !!}</td>
                        <td class="text-center">{!! $assessor->caseload->count() !!}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($assessor->departments as $dept)
                                    <li>{!! $dept->department !!}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($assessor->sectors as $sector)
                                    <li>{!! $sector->name !!}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($assessor->processes as $process)
                                    <li>{!! $process->name !!}</li>
                                @endforeach
                            </ul>
                        </td>
                        @if( $currentUser->hasAccess('judiAdmin') )
                            <td class="text-center">
                                <div class="actions">
                                    <a class="btn btn-circle btn-primary btn-xs" href="{!! URL::route('judi.assessors.edit', $assessor->id) !!}"><i class="fa fa-pencil"></i></a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop