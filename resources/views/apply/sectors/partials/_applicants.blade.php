<tr>
    <th></th>
    <th class="text-right">TOTAL</th>
    @foreach($data as $key => $period)
        <th class="text-right">
            {!! $period->count() !!} /
            {!! $period->filter->hasStarted()->count() !!}
        </th>
    @endforeach
    <th class="text-right">
        {!! $applicants->count() !!} /
        {!! $applicants->filter->hasStarted()->count() !!}
    </th>
</tr>
</thead>
@foreach($sectors as $sector)
    <tr>
        <td>{!! $sector->code !!}</td>
        <td>{!! $sector->name !!}</td>
        @foreach($data as $key => $period)
            <td class="text-right">
                <a href="{!! route('apply.sectors.show', ['id' => $sector->id, 'period' => $key, 'programme_group' => request('programme_group')]) !!}">
                    {!! $period->where('sector_id', $sector->id)->count() !!} /
                    {!! $period->where('sector_id', $sector->id)->filter->hasStarted()->count() !!}
                </a>
            </td>
        @endforeach
        <td class="text-right">
            {!! countSectorPipelineInYear($data, $sector->id) !!} /
            {!! countSectorStartsInYear($data, $sector->id) !!}
        </td>
    </tr>
@endforeach