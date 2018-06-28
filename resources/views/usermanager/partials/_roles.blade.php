<div class="panel panel-default">
    @include('partials.panels._head', [
        'title' => 'Job Role Functions',
    ])

    {!! Form::model($user, [ 'route' => [ 'account.update', $user->id ] ]) !!}
    <div class="table-responsive">
        <table class="table table-striped">
            @foreach ($roles as $role)
                <tr>
                    <td width="5%">{!! Form::checkbox( 'role_id[]', $role->id, checkboxState( $role->id, $userRoleIds ) ) !!}</td>
                    <td>{!! $role->job_role !!}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="panel-footer">
        <div class="form-actions">
            {!! Form::hidden('ruleset', 'roles') !!}
            {!! Form::submit('Save', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>