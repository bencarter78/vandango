<div class="alert alert-{!! $level or 'warning' !!}">
    @if($level == 'danger' || $level == 'warning')
        <i class="fa fa-warning"></i>
    @else
        <i class="fa fa-info-circle"></i>
    @endif
    <strong>{!! $msg !!}</strong>
</div>