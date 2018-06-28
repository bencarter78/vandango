<div class="panel panel-default">

    @include('partials.panels._head', ['title' => 'General Information'])

    {!! Form::model($user, [ 'route' => [ 'account.update', $user->id ] ]) !!}

    <div class="panel-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._text', ['label' => 'First Name', 'field' => 'first_name', 'value' => isset($user) ? $user->first_name : null])
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._text', ['label' => 'Surname', 'field' => 'surname', 'value' => isset($user) ? $user->surname : null])
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._email', ['label' => 'Email', 'field' => 'email', 'value' => isset($user) ? $user->email : null])
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._text', ['label' => 'Tel', 'field' => 'tel', 'value' => isset($user->meta) ? $user->meta->present()->formatTel : null])
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._text', ['label' => 'Mobile', 'field' => 'mobile', 'value' => isset($user->meta) ? $user->meta->present()->formatMobile : null])
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._text', ['label' => 'Extension', 'field' => 'ext', 'value' => isset($user->meta) ? $user->meta->ext : null])
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="form-actions">
            {!! Form::hidden('ruleset', 'general') !!}
            {!! Form::submit('Save', array('class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>