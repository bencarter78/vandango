<div class="row">
    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._text', ['label' => 'Street Address', 'field' => 'add1', 'value' => isset($location) ? $location->add1 : null])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._text', ['label' => 'Address Line 2', 'field' => 'add2', 'value' => isset($location) ? $location->add2 : null])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._text', ['label' => 'Address Line 3', 'field' => 'add3', 'value' => isset($location) ? $location->add3 : null])
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._text', ['label' => 'Town', 'field' => 'town', 'value' => isset($location) ? $location->town : null])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._text', ['label' => 'County', 'field' => 'county', 'value' => isset($location) ? $location->county : null])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._text', ['label' => 'Post Code', 'field' => 'postcode', 'value' => isset($location) ? $location->postcode : null])
        </div>
    </div>
</div>