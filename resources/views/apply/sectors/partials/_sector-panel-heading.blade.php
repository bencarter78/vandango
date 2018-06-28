<small>
    {!! request('programme_group') !!}
    <ul class="nav nav-pills pull-right">
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-calendar"></i>
                Period {!! request('period') !!}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                @foreach(range(1, 12) as $p)
                    <li>
                        <a href="{!! route('apply.sectors.show', ['id' => request()->segment(3), 'period' => $p, 'programme_group' => request('programme_group')]) !!}">
                            Period {!! $p !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-inbox"></i> {!! $applicants->count() !!} {!! str_plural('applicant', $applicants->count()) !!}
            </a>
        </li>
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-users"></i> {!! $applicants->filter->hasStarted()->count() !!} {!! str_plural('start', $applicants->filter->hasStarted()->count()) !!}
            </a>
        </li>
    </ul>
</small>