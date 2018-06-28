<div class="form-group spacer-bottom-3x">
    {!! Form::label('Category Name') !!}
    {!! Form::text('name', isset($category->name) ? $category->name : null, array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'name' ] )
</div>

<div class="form-group">
    {!! Form::label('Category Color') !!}
    <select class="form-control" name="color">
        <option>Please select...</option>
        @foreach(cssColors() as $key => $value)
            <option value="{!! $key !!}" {!! isset($category->color) && $category->color == $key ? 'selected' : ''!!}>
                {!! $value !!}
            </option>
        @endforeach
    </select>
    @include('partials/forms/_error', ['field' => 'color'])
</div>


{!! Form::submit($submit, array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}