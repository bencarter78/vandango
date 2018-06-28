<div class="panel panel-default">
    @include('partials.panels._head', [
        'title' => 'Groups',
    ])

    {!! Form::model($user, [ 'route' => [ 'account.update', $user->id ] ]) !!}
    <div class="table-responsive">
        <table class="table table-striped">
            @foreach ($groups as $group)
                <tr>
                    <td width="5%">{!! Form::checkbox( 'group_id[]', $group->id, checkboxState( $group->id, $userGroupIds ) ) !!}</td>
                    <td>{!! $group->name !!}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="panel-footer">
        <div class="form-actions">
            {!! Form::hidden('ruleset', 'groups') !!}
            {!! Form::submit('Save', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>