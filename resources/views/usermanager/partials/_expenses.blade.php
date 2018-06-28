<div class="panel panel-default">
    @include('partials.panels._head', [
        'title' => 'Expenses',
    ])

    {!! Form::model($user, [ 'route' => [ 'account.update', $user->id ] ]) !!}
    <div class="panel-body">

        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Home Location') !!}
            {!! Form::text('home', isset($user->expenses->home) ? $user->expenses->home : '', [ 'class' => 'form-control' ]) !!}
            @include('partials/forms/_error', [ 'field' => 'home' ] )
        </div>

        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Base') !!}
            {!! Form::select('base', dropdownOptions($centres, 'name'), isset($user->expenses->base) ? $user->expenses->base : '', ['class' => 'form-control' ]) !!}
            @include('partials/forms/_error', [ 'field' => 'base' ])
        </div>

        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Car Registration') !!}
            {!! Form::text('reg_number', isset($user->expenses->reg_number) ? $user->expenses->reg_number : '', [ 'class' => 'form-control' ]) !!}
            @include('partials/forms/_error', [ 'field' => 'reg_number' ] )
        </div>

        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Engine Size') !!}
            {!! Form::text('engine_size', isset($user->expenses->engine_size) ? $user->expenses->engine_size : '', [ 'class' => 'form-control' ]) !!}
            @include('partials/forms/_error', [ 'field' => 'engine_size' ] )
        </div>

        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Insurance Cover') !!}
            {!! Form::select('cover_type', dropdownOptions( [1 => 'Fully Comprehensive', 2 => 'Third Party' ]), isset($user->expenses->cover_type) ? $user->expenses->cover_type : '', ['class' => 'form-control' ]) !!}
            @include('partials/forms/_error', [ 'field' => 'cover_type' ])
        </div>

        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Car Allowance') !!}
            {!! Form::select('car_allowance', dropdownOptions( [1 => 'Yes', 0 => 'No' ]), isset($user->expenses->car_allowance) ? $user->expenses->car_allowance : '', ['class' => 'form-control' ]) !!}
            @include('partials/forms/_error', [ 'field' => 'car_allowance' ])
        </div>

        <div class="form-group spacer-bottom-3x">
            {!! Form::label('45p Scheme') !!}
            {!! Form::select('tax_scheme', dropdownOptions( [1 => 'Yes', 0 => 'No' ]), isset($user->expenses->tax_scheme) ? $user->expenses->tax_scheme : '', ['class' => 'form-control' ]) !!}
            @include('partials/forms/_error', [ 'field' => 'tax_scheme' ])
        </div>

        {!! Form::submit('Update', [ 'name' => 'submit', 'class' => 'btn btn-secondary btn-lg' ]) !!}

    </div>
    {!! Form::hidden('ruleset', 'expenses') !!}
    {!! Form::close() !!}
</div>

@include('......partials.dates._datepicker')