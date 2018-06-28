<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Course/Qualification</th>
            <th>Venue</th>
            <th class="text-center">Start Date</th>
            <th class="text-center">End Date</th>
            <th class="text-right">Cost</th>
            <th class="text-center">Agreement</th>
        </tr>
        @foreach($user->timetable as $timetable)
            <tr>
                <td>{!! $timetable->course->name !!}</td>
                <td>{!! $timetable->venue->name !!} - {!! $timetable->venue->site->name !!}, {!! $timetable->venue->site->location->town !!}</td>
                <td class="text-center">{!! $timetable->starts_at->format('d/m/Y') !!}</td>
                <td class="text-center">{!! $timetable->ends_at->format('d/m/Y') !!}</td>
                <td class="text-right">£{!! number_format($timetable->pivot->cost, 2, '.', ',') !!}</td>
                <td class="text-center">
                    @if($timetable->agreements->where('user_id', $user->id)->first())
                        @if($timetable->agreements->where('user_id', $user->id)->first()->is_signed)
                            Agreed on
                            {!! $timetable->agreements->where('user_id', $user->id)->first()->deleted_at->format('d/m/Y') !!}
                        @else
                            @if(Auth::user()->id === $user->id)
                                <a href="{!! route('classroom.me.learning-agreements.edit', $timetable->agreements->where('user_id', $user->id)->first()->id) !!}" class="btn btn-secondary">
                                    Sign
                                </a>
                            @else
                                Pending
                            @endif
                        @endif
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>