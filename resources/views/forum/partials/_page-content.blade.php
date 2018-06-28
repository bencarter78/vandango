<div class="row">
    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
        @include('forum.partials._sidebar')

        <div class="spacer-top-3x visible-xs">
            @include('forum.partials._channels')
        </div>
    </div>

    <div class="col-xs-8 col-sm-9 col-md-9 col-lg-10">
        <div class="panel panel-default">
            @if(isset($title))
                <div class="panel-heading">
                    {{ $title }}
                </div>
            @endif

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8 col-md-9 col-lg-9">
                        {{ $slot }}
                    </div>
                    <div class="hidden-xs col-sm-4 col-md-3 col-lg-3 padding-left-3x" style="border-left: solid 1px lightgrey">
                        <div class="spacer-bottom-3x">
                            @include('forum.partials._channels')
                        </div>

                        <div class="spacer-bottom-3x">
                            @include('forum.partials._trending')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>