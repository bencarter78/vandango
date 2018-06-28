<div class="row spacer-top-5x">
    @foreach($apps as $app)
        <div class="col-sm-6 col-md-3 text-center spacer-bottom-5x">
            <a href="{!! URL::to($app->slug) !!}" class="">
                <i class="fa fa-fw fa-{!! $app->icon !!} fa-5x"></i>
                <h4>{!! $app->title !!}</h4>
            </a>
        </div>
    @endforeach
</div>