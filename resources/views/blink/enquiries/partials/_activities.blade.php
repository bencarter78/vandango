@foreach($enquiry->activities->sortByDesc('due_at') as $activity)
    <article class="spacer-bottom-5x timeline">
        <div class="article-header">
            <h6>
                <i class="fa fa-calendar"></i>
                @if($activity->due_at)
                    {!! $activity->due_at->format('jS F Y') !!}
                @else
                    {!! $activity->created_at->format('jS F Y') !!}
                @endif
            </h6>
        </div>
        <div class="article-body">
            <p>{!! $activity->note !!}</p>
        </div>
        <div class="article-footer">
            <small class="text-gray-light">
                <span class="text-secondary"><i class="fa fa-user-circle"></i></span>
                <span class="text-gray-dark">
                    {!! isset($activity->updatedBy) ? $activity->updatedBy->present()->name : 'VanDango Blink' !!}
                </span>
                on {!! $activity->created_at->format('d/m/Y H:i') !!}
            </small>
        </div>
    </article>
@endforeach