<div class="panel-heading clearfix">
    @if($currentUser->hasAccess(isset($access) ? $access : 'admin') || !isset($access))
        @if( isset($buttonRoute) )
            <div class="{!! $buttonClass or 'pull-right' !!}">
                <a href="{!! URL::route($buttonRoute, isset($buttonRouteParameters) ? $buttonRouteParameters : null) !!}" class="btn btn-secondary">
                    <i class="fa fa-{!! $buttonIcon or 'plus' !!}"></i> {!! $buttonText !!}
                </a>
            </div>
        @endif
    @endif
    <h4 class="{!! $titleClass or '' !!}">{!! $title or 'Panel Title' !!}</h4>
</div>