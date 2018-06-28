<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th></th>
            @foreach($grades as $grade)
                <th class="text-center">{!! $grade->name !!}</th>
            @endforeach
        </tr>
        </thead>
        @foreach($summaryData['process'] as $process => $assessment)
            <tr>
                <th>{!! $processes->where('id', $process)->first()->name !!}</th>
                @foreach($assessment as $count)
                    <td class="text-center">{!! current( $count ) !!}</td>
                @endforeach
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>Total</th>
            @foreach($summaryData['totals'] as $total)
                <th class="text-center">{!! count($total) !!}</th>
            @endforeach
        </tr>
        </tfoot>
    </table>
</div>