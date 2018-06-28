@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Your Staff</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                </tr>
                @foreach($users->sortBy('first_name') as $user)
                    <tr>
                        <td>
                            {!! link_to('classroom/manager/staff/' . $user->id, $user->present()->name ) !!}
                            {!! $user->meta->present()->onProbation !!}
                        </td>
                        <td>{!! implode(', ', $user->departments->pluck('department')->all()) !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop