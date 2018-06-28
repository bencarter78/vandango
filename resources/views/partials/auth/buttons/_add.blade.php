@if($currentUser->hasAccess($permission))
    <div class="pull-right">
        <a href="{!! URL::route($route) !!}" class="btn btn-secondary"><i class="fa fa-plus"></i> {!! $label !!}</a>
    </div>
@endif