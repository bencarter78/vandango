<div class="panel panel-default">
    @include('partials.panels._head', [
        'title' => 'Departments',
    ])

    {!! Form::model($user, [ 'route' => [ 'account.update', $user->id ] ]) !!}
    <div class="table-responsive">
        <table class="table table-striped">
            @foreach ($departments as $department)
                <tr>
                    <td width="5%">{!! Form::checkbox( 'department_id[]', $department->id, checkboxState( $department->id, $userDepartmentIds ) ) !!}</td>
                    <td>{!! $department->department !!}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="panel-footer">
        <div class="form-actions">
            {!! Form::hidden('ruleset', 'departments') !!}
            {!! Form::submit('Save', array('name' => 'submit', 'class' => 'btn btn-secondary')) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>