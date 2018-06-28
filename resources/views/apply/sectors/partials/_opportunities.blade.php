<tr>
    <th></th>
    <th class="text-right">TOTAL</th>
    @foreach($data as $key => $period)
        <th class="text-right">
            {!! calculateRemainingOpportunitiesInPeriod($period) !!}
        </th>
    @endforeach
    <th class="text-right">
        {!! calculateRemainingOpportunitiesInYear($opportunities) !!}
    </th>
</tr>
</thead>
@foreach($sectors as $sector)
    <tr>
        <td>{!! $sector->code !!}</td>
        <td>{!! $sector->name !!}</td>
        @foreach($data as $key => $opportunities)
            <td class="text-right">
                <a href="{!! route('apply.sectors.show', ['id' => $sector->id, 'period' => $key, 'programme_group' => request('programme_group')]) !!}">
                    {!! calculateRemainingOpportunities($opportunities->where('sector_id', $sector->id)) !!}
                </a>
            </td>
        @endforeach
        <td class="text-right">
            {!! calculateRemainingSectorOpportunitiesInYear($data, $sector->id) !!}
        </td>
    </tr>
@endforeach