<div class="panel panel-default">
    <div class="panel-head"><h4>Filter</h4></div>

    <div class="panel-body">
        {!! Form::open( ['route' => $route, 'class' => 'form-horizontal', 'method' => 'get' ]) !!}
        @include('judi.analysis._partials._date-range')

        @if(isset($grades))
            @include('judi.analysis._partials._checkboxes', [
                'items' => $grades,
                'field' => 'grade_id',
                'label' => 'Grades',
            ])
        @endif

        @if(isset($processes))
            @include('judi.analysis._partials._checkboxes', [
                'items' => $processes,
                'field' => 'process_id',
                'label' => 'Processes',
            ])
        @endif

        @if(isset($criteria))
            @include('judi.analysis._partials._checkboxes', [
                'items' => $criteria,
                'field' => 'criteria_id',
                'label' => 'Criteria',
                'overflow' => true,
            ])
        @endif

        @if(isset($sectors))
            @include('judi.analysis._partials._checkboxes', [
                'items' => $sectors,
                'field' => 'sector_id',
                'label' => 'Sectors',
                'overflow' => true,
            ])
        @endif

        {!! Form::submit('Search', array('class' => 'btn btn-secondary btn-block')) !!}
        {!! Form::close() !!}

    </div>
</div>