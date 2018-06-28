<h5 class="text-upper text-gray-light">
    Trending
</h5>

<ul class="list-unstyled">
    @foreach($trendingThreads as $thread)
        <li class="spacer-bottom-1x">
            <a href="{{ route('forum.threads.show', $thread->slug) }}" class="is-link">
                <i class="fa fa-fire spacer-right-x text-danger"></i>
                {{ $thread->title }}
            </a>
        </li>
    @endforeach
</ul>