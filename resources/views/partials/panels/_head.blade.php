<div class="panel-heading clearfix">
    @if(isset($button))
        @if($currentUser->hasAccess(isset($button['access']) ? $button['access']: 'admin'))
            @if( isset($button['route']) )
                <div class="{!! $button['class'] or 'pull-right' !!}">
                    <a href="{!! $button['route'] !!}" class="btn btn-secondary">
                        <i class="fa fa-{{ $button['icon'] or 'plus' }}"></i>
                        {{ $button['text'] or 'Create' }}
                    </a>
                </div>
            @endif
        @endif
    @endif

    <h4 class="">{{ $title }}</h4>
</div>