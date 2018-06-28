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
        @foreach($data->groupBy('criteria_name') as $criteria)
            <tr>
                <th>{!! $criteria->first()->criteria_name !!}</th>
                @foreach($grades as $grade)
                    <td class="text-center">{!! $criteria->where('grade_name', $grade->name)->count() !!}</td>
                @endforeach
            </tr>
        @endforeach
        <tfoot>
            <tr>
                <th>Total</th>
                @foreach($grades as $grade)
                    <td class="text-center">{!! $data->where('grade_name', $grade->name)->count() !!}</td>
                @endforeach
            </tr>
        </tfoot>
    </table>
</div>