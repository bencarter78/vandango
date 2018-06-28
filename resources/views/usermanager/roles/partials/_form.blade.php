<div class="form-group">
    {!! Form::label('Job Role') !!}
    {!! Form::text('job_role', isset($role->job_role) ? $role->job_role : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'job_role' ] )
</div>