{!! csrf_field() !!}
<input type="hidden" value="{!! $course->id or '' !!}" name="id"/>

<div class="row">
    <div class="col-md-4 spacer-bottom-2x">
        <div class="form-group">
            {!! Form::label('Course Name / Qualification Title') !!}
            {!! Form::text(
                'name',
                isset($course->name) ? $course->name : null,
                ['class' => 'form-control']
            ) !!}
            @include('partials/forms/_error', [ 'field' => 'name' ] )
        </div>
    </div>

    <div class="col-md-4 spacer-bottom-2x">
        <div class="form-group">
            {!! Form::label('Aim Reference') !!}
            {!! Form::text(
                'aim_ref',
                isset($course->aim_ref) ? $course->aim_ref : null,
                ['class' => 'form-control']
            ) !!}
            @include('partials/forms/_error', [ 'field' => 'aim_ref' ] )
        </div>
    </div>

    <div class="col-md-4 spacer-bottom-2x">
        <div class="form-group">
            {!! Form::label('Type') !!}
            {!! Form::select(
                'course_type_id',
                dropdownOptions($types, 'name'),
                isset($course->course_type_id) ? $course->course_type_id : '',
                ['class' => 'form-control']
            ) !!}
            @include('partials/forms/_error', ['field' => 'course_type_id'])
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 spacer-bottom-2x">
        <div class="form-group">
            {!! Form::label('Mandatory') !!}
            {!! Form::select(
                'is_mandatory',
                dropdownOptions(boolOptions()),
                isset($course->is_mandatory) ? $course->is_mandatory : '',
                ['class' => 'form-control']
            ) !!}
            @include('partials/forms/_error', ['field' => 'is_mandatory'])
        </div>
    </div>

    <div class="col-md-4 spacer-bottom-2x">
        <div class="form-group">
            {!! Form::label('Learning Agreement Required') !!}
            {!! Form::select(
                'is_agreement_required',
                dropdownOptions(boolOptions()),
                isset($course->is_agreement_required) ? $course->is_agreement_required : '',
                ['class' => 'form-control']
            ) !!}
            @include('partials/forms/_error', ['field' => 'is_agreement_required'])
        </div>
    </div>

    <div class="col-md-4 spacer-bottom-2x">
        <div class="form-group">
            {!! Form::label('Cost') !!}
            <div class="input-group">
                <span class="input-group-addon">£</span>
                {!! Form::text(
        	    'cost',
        	    isset($course->cost) ? $course->cost : null,
        	    ['class' => 'form-control']
            ) !!}
                @include('partials/forms/_error', [ 'field' => 'cost' ] )
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 spacer-bottom-2x">
        <div class="form-group">
            {!! Form::label('Resources Link') !!}
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-link"></i></span>
                {!! Form::text(
                    'resource_url',
                    isset($course->resource_url) ? $course->resource_url : null,
                    ['class' => 'form-control']
                ) !!}
                @include('partials/forms/_error', [ 'field' => 'resource_url' ] )
            </div>
        </div>
    </div>
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Description') !!}
    {!! Form::textarea(
        'description',
        isset($course->description) ? $course->description : null,
        ['class' => 'form-control']
    ) !!}
    @include('partials/forms/_error', [ 'field' => 'description' ] )
</div>

<div class="form-group spacer-bottom-3x">
    <label for="role_id">Is this course specifically for any of the listed job roles?</label>
    <ul class="list-unstyled">
        @foreach ($roles as $role)
            <li class="spacer-bottom-1x">
                {!! Form::checkbox( 'role_id[]', $role->id, checkboxState( $role->id, isset($course) ? $course->roles->pluck('id')->all() : '' ) ) !!}
                {!! $role->job_role !!}
            </li>
        @endforeach
    </ul>
</div>

{!! Form::submit('Save', ['name' => 'submit', 'class' => 'btn btn-secondary btn-lg']) !!}