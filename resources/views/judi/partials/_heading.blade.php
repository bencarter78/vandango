<div class="panel-heading clearfix">
    @if($currentUser->hasAccess('judiPa') || $currentUser->hasAccess('judiAdmin'))
        @if( isset($buttonRoute) )
            <div class="{!! $buttonClass or 'pull-right' !!}">
                <a href="{!! URL::route($buttonRoute, $buttonRouteParameters) !!}" class="btn btn-secondary"><i class="fa fa-{!! $buttonIcon or 'plus' !!}"></i>
                    {!! $buttonText !!}</a>
            </div>
        @endif
    @endif
    <h4 class="{!! $titleClass or '' !!}">{!! $title or 'Panel Title' !!}</h4>
</div>