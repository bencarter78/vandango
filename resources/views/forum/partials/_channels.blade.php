<h5 class="text-upper text-gray-light">Channels</h5>

<ul class="list-unstyled">
    @foreach($channels as $channel)
        <li class="spacer-bottom-1x">
            <a href="{{ route('forum.threads.index', $channel->slug) }}">
                <i class="fa fa-circle-o spacer-right-x" style="color: {{ $channel->color }}"></i>
                {{ $channel->name }}
            </a>
        </li>
    @endforeach
</ul>