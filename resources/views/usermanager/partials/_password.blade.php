<div class="panel panel-default">
    @include('partials.panels._head', [
        'title' => 'Change Your Password',
    ])

    {!! Form::model($user, [ 'route' => [ 'account.update', $user->id ] ]) !!}

    <div class="panel-body">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._password', ['label' => 'Current Password', 'field' => 'oldPassword'])
        </div>

        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._password', ['label' => 'New Password', 'field' => 'password'])
        </div>

        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._password', ['label' => 'Confirm New Password', 'field' => 'password_confirmation'])
        </div>

    </div>

    <div class="panel-footer">
        <div class="form-actions">
            {!! Form::hidden('ruleset', 'password') !!}
            {!! Form::submit('Save', array('class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>

    {!! Form::close() !!}
</div>