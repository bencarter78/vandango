<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Start/End Date</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>
                    <a href="{!! URL::route('account.edit', $user->username) !!}">{!! $user->present()->name !!}</a>
                </td>
                <td>
                    @if($user->departments->count() > 0)
                        @foreach($user->departments as $department)
                            {!! $department->department !!}
                        @endforeach
                    @endif
                </td>
                <td>
                    @if($user->deleted_at)
                        {!! $user->deleted_at->format('M jS Y') !!}
                    @else
                        @if($user->meta)
                            {!! $user->meta->start_date->format('M jS Y') !!}
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>