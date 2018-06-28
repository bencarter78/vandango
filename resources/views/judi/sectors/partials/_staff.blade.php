<div class="panel panel-default">
    <div class="panel-heading clearfix"><h4>Linked Staff</h4></div>
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
                                        <li>{!! $process->name !!}</li>
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>