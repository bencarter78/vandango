<div class="table-responsive">
    <table class="table">
        <tr>
            <th>NAS Ref</th>
            <th>Status</th>
            <th>Title</th>
            <th>Sector</th>
            <th>Framework</th>
            <th>Location</th>
            <th>Closes</th>
            <th class="text-center">Applications</th>
            <th class="text-center">Actions</th>
        </tr>
        @foreach($vacancies as $vacancy)
            <tr class="{{ $vacancy->trashed() ? 'danger' : '' }}">
                <td>{!! $vacancy->ref or 'N/A' !!}</td>
                <td>
                    @if($vacancy->trashed())
                        Vacancy Archived
                    @else
                        {!! $vacancy->statuses->last()->name !!}
                    @endif
                </td>
                <td>{!! $vacancy->title !!}</td>
                <td>{!! isset($vacancy->sector) ? $vacancy->sector->name : '' !!}</td>
                <td>{!! isset($vacancy->framework) ? $vacancy->framework->full_name : '' !!}</td>
                <td>{{ isset($vacancy->location) ? $vacancy->location->address : '' }}</td>
                <td>{!! isset($vacancy->closes_on) ? $vacancy->closes_on->format('d/m/Y') : '' !!}</td>
                <td class="text-center">
                    @if($vacancy->ref)
                        <ava-application-count nas-ref="{!! $vacancy->ref !!}"></ava-application-count>
                    @endif
                </td>
                <td class="text-center">
                    <small class="text-upper">
                        @if($vacancy->isDraft())
                            <a href="{!! route('blink.vacancies.edit', $vacancy->id) !!}" class="is-link">
                                Edit
                            </a> |
                        @endif
                        <a href="{!! route('blink.vacancies.show', $vacancy->id) !!}" class="is-link">
                            View
                        </a>
                    </small>
                </td>
            </tr>
        @endforeach
    </table>
</div>