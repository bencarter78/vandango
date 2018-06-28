<div class="form-group">
    {!! Form::label('Process Name') !!}
    {!! Form::text('name', isset($process->name) ? $process->name : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'name' ] )
</div>

<div class="form-group">
    {!! Form::label('Trigger Point') !!}
    <p>The number of weeks after a new start to trigger</p>
    {!! Form::select('trigger_week', range(1,52), isset($process->trigger_week) ? $process->trigger_week : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'trigger_week' ] )
</div>

{!! Form::label('Linked Job Roles') !!}
<div class="table-responsive">
    <table class="table table-striped">
        @foreach ($roles as $role)
            <tr>
                @if( isset($process) )
                    <td width="5%">{!! Form::checkbox( 'role_id[]', $role->id, checkboxState( $role->id, $process->roles()->pluck('role_id')->all() ) ) !!}</td>
                @else
                    <td width="5%">{!! Form::checkbox( 'role_id[]', $role->id ) !!}</td>
                @endif
                <td>{!! $role->job_role !!}</td>
            </tr>
        @endforeach
    </table>
</div>

{!! Form::label('Linked Process Reports') !!}
<div class="table-responsive">
    <table class="table table-striped">
        @foreach ($reports as $report)
            <tr>
                @if( isset($process) )
                    <td width="5%">{!! Form::checkbox( 'report_id[]', $report->id, checkboxState( $report->id, $process->reports()->pluck('report_id')->all() ) ) !!}</td>
                @else
                    <td width="5%">{!! Form::checkbox( 'report_id[]', $report->id ) !!}</td>
                @endif
                <td>{!! $report->title !!}</td>
            </tr>
        @endforeach
    </table>
</div>