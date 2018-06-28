@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        @include('partials.panels._head', [
            'title' => 'All Sites',
            'button' => ['access' => 'roommate','route' => route('roommate.sites.create')]
        ])

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Town</th>
                    @include('partials.tables._th-actions', ['access' => 'roommate'])
                </tr>
                @foreach($sites as $site)
                    <tr>
                        <td>
                            {!! $site->name !!}
                            @if(!$site->is_owned)
                                <span class="badge badge-warning">ex</span>
                            @endif
                        </td>
                        <td>
                            @if($site->location)
                                {!! $site->location->town !!}
                            @endif
                        </td>
                        @include('partials.tables._td-actions', ['access' => 'roommate', 'model' => $site, 'route' => 'roommate.sites.edit'])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop

@include('partials.modals._delete', ['model' => $sites, 'title' => 'Site', 'route' => 'roommate.sites.destroy', ])