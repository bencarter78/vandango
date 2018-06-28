<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Name</th>
            <th>PA Processes</th>
        </tr>
        @foreach($users->sortBy('first_name') as $user)
            <tr>
                <td>
                    {!! link_to_route('judi.assessments.user.planned', $user->present()->name, $user->id ) !!}
                    {!! $user->meta->present()->onProbation !!}
                </td>
                <td>
                    <ul class="list-unstyled">
                        @foreach($user->roles as $role)
                            @if($role->processes)
                                @foreach($role->processes as $process)
                                    <li>
                                        {!! $process->name !!}
                                        {!! getAssessmentProcessType($user->assessmentSettings, $process->id) !!}
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
</div>