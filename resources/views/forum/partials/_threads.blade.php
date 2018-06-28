@forelse($threads as $thread)
    <article class="spacer-bottom-3x">
        <div class="heading">
            <span class="pull-right">
                <ul class="list-inline">
                    <li>
                        <i class="fa fa-commenting-o"></i>
                        {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                    </li>
                    <li>
                        <i class="fa fa-eye"></i>
                        {{ $thread->views }} {{ str_plural('view', $thread->views) }}
                    </li>
                </ul>
            </span>
            <h4>
                <a href="{{ route('forum.threads.show', $thread->slug) }}" class="is-link">
                    {{ $thread->title }}
                </a>
            </h4>
        </div>

        <div class="font-size-small spacer-bottom-1x">
            Posted by
            <a href="{{ route('forum.threads.index') . '?by=' . $thread->creator->username }}" class="is-link">
                {{ $thread->creator->fullName }}
            </a>
            {{ $thread->created_at->diffForHumans() }}
            @if($thread->replies_count > 0)
                |
                <i class="fa fa-commenting-o"></i>
                {{ $thread->replies->last()->owner->fullName }} replied
                {{ $thread->replies->last()->created_at->diffForHumans() }}
            @endif
        </div>

        <div class="spacer-bottom-2x">
            {!! $thread->excerpt(250) !!}&hellip;
        </div>

        <a href="{{ route('forum.threads.index', $thread->channel->slug) }}" class="label label-default font-size-small" style="background-color: {{ $thread->channel->color }};">
            <i class="fa fa-tag"></i>
            {{ $thread->channel->name }}
        </a>
    </article>

    <hr class="spacer-bottom-3x">

@empty
    <p>Sorry, there are no questions here.</p>
@endforelse

{{ $threads->render() }}