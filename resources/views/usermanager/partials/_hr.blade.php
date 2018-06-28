<div class="panel panel-default">
    @include('partials.panels._head', [
        'title' => 'HR Information',
    ])

    {!! Form::model($user, [ 'route' => [ 'account.update', $user->id ] ]) !!}

    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._datepicker', [
                        'label' => 'Start Date', 
                        'field' => 'start_date',
                        'value' => isset($user->meta) ? $user->meta->start_date->format('d/m/Y') : null
                    ])
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._datepicker', [
                        'label' => 'Probation End Date', 
                        'field' => 'probation_end_date', 
                        'value' => isset($user->meta->probation_end_date) ? $user->meta->probation_end_date->format('d/m/Y') : null
                    ])
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    @include('partials.forms._datepicker', [
                        'label' => 'Appraisal Date', 
                        'field' => 'appraisal_date', 
                        'value' => isset($user->meta->appraisal_date) ? $user->meta->appraisal_date->format('d/m/Y') : null
                    ])
                </div>
            </div>
        </div>

    </div>

    <div class="panel-footer">
        <div class="form-actions">
            {!! Form::hidden('ruleset', 'hr') !!}
            {!! Form::submit('Save', array('class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>