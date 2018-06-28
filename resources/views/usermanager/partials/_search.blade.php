<div class="row spacer-bottom-1x">
    <div class="col-md-12">
        <div class="well">
            {!! Form::open(array('route' => $route, 'class' => 'form-horizontal', 'method' =>'get')) !!}
            <div class="input-group custom-search-form">
                {!! Form::text(
                    'q',
                    isset($search) ? $search : '',
                    [
                        'class' => 'form-control',
                        'placeholder' => 'Search ' . stringFromExploder($route, '.') . '...'
                    ]
                ) !!}
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">
                      <span class="glyphicon glyphicon-search"></span>
                  </button>
                </span>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>