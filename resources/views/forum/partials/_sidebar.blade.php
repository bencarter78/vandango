<div class="sidebar">
    <a href="{{ route('forum.threads.create') }}" class="btn btn-block btn-success text-upper">New Thread</a>

    <ul class="nav spacer-top-3x">
        <li class="text-upper font-size-small text-gray-dark padding-x">
            <a href="{{ route('forum.threads.index') }}">
                <i class="spacer-right-1x fa fa-fw fa-globe"></i>
                All
            </a>
        </li>
        <li class="text-upper font-size-small text-gray-dark padding-x">
            <a href="{{ route('forum.threads.index') . '?by=' . $currentUser->username }}">
                <i class="spacer-right-1x fa fa-fw fa-lightbulb-o"></i>
                My Threads
            </a>
        </li>
        <li class="text-upper font-size-small text-gray-dark padding-x">
            <a href="{{ route('forum.threads.index') . '?unanswered=true' }}">
                <i class="spacer-right-1x fa fa-fw fa-inbox"></i>
                Unanswered
            </a>
        </li>
        <li class="text-upper font-size-small text-gray-dark padding-x">
            <a href="{{ route('forum.threads.index') . '?popular=true' }}">
                <i class="spacer-right-1x fa fa-fw fa-fire"></i>
                Most Popular
            </a>
        </li>
    </ul>
</div>