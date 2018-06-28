@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                @if ( $currentUser->id == $user->id || $currentUser->hasAccess('admin') || isLineManager( $currentUser->id, $user ) )
                    <a class="pull-right btn btn-secondary" href="{!! URL::route('account.edit', $user->username) !!}">
                        Edit
                    </a>
                @endif
                {!! $user->fullName !!}
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>Overview</h4>
                        </li>
                        @if($user->meta->start_date)
                            <li class="list-group-item">
                                <strong>Started:</strong>
                                {!! $user->meta->start_date->format('d/m/Y') !!}
                            </li>
                        @endif
                        <li class="list-group-item">
                            <ul class="list-inline actions">
                                <li><strong>Manager:</strong></li>
                                @foreach($user->getManagers() as $manager)
                                    <li>{!! $manager->fullName !!}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <strong>Probation:</strong>
                            {!! $user->meta->probation_end_date ? $user->meta->probation_end_date->format('d/m/Y') : 'No' !!}
                        </li>
                    </ul>
                </div>

                <div class="col-md-9">
                    <ul class="nav nav-tabs spacer-bottom-3x" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a>
                        </li>
                        <li role="presentation">
                            <a href="#departments" aria-controls="departments" role="tab" data-toggle="tab">Departments</a>
                        </li>
                        <li role="presentation">
                            <a href="#functions" aria-controls="functions" role="tab" data-toggle="tab">
                                Job Functions
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">Permissions</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="general">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>First Name</th>
                                        <td>{!! $user->first_name !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Surname</th>
                                        <td>{!! $user->surname !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Landline</th>
                                        <td>
                                            {!! formatTel($user->meta->tel) !!}
                                            @if($user->meta->ext)
                                                +{!! $user->meta->ext !!}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>{!! formatTel($user->meta->mobile) !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="departments">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Departments</th>
                                        <th>Sectors</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <ul class="list-unstyled">
                                                @foreach($user->departments as $dept)
                                                    <li>{!! $dept->department !!}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @foreach($user->sectors as $sector)
                                                    <li>{!! $sector->title !!}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="functions">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Function</th>
                                    </tr>
                                    @foreach($user->roles as $role)
                                        <tr>
                                            <td>{!! $role->job_role !!}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="groups">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Group</th>
                                    </tr>
                                    @foreach($user->groups as $group)
                                        <tr>
                                            <td>{!! $group->name !!}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
