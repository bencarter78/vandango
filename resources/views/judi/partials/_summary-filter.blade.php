<div class="row">
    <div class="col-xs-12 col-sm-3 col-md-3">
        @include('judi.partials._filter')
    </div>

    <div class="col-xs-12 col-sm-9 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h4>
                    @if($data)
                        {!! $data->total() !!}
                    @endif
                    Submitted Summaries
                </h4>
            </div>

            <div class="panel-body">
                @if($data)
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tabular" aria-controls="tabular" role="tab" data-toggle="tab">Tabular</a></li>
                        <li role="presentation">
                            <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">Summarised</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active padding-top-2x" id="tabular">
                            @include('judi.partials._summaries')
                        </div>

                        <div role="tabpanel" class="tab-pane padding-top-2x" id="summary">
                            @include('judi.partials._summaries-summarised')
                        </div>
                    </div>
                @else
                    <p>
                        Looks like you've not selected any filtering, so pick some dates, tick some boxes and click
                        search to see some data.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>