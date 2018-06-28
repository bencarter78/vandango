<li><a href="{!! route('apply.dashboard') !!}"><i class="fa fa-fw fa-home"></i> Apply</a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pipeline <span class="badge badge-primary">New</span></a>
    <ul class="dropdown-menu">
        <li><a href="{!! route('apply.reports.index') !!}">Named Starts</a></li>
    </ul>
</li>
<li><a href="{!! route('apply.sectors.index') !!}">Sectors</a></li>
<li><a href="{!! route('apply.me.applicants.index') !!}">My Applicants</a></li>
@if($currentUser->hasAccess('applyAdmin'))
    <li><a href="{!! route('apply.applicants.index') !!}">Applicants</a></li>
@endif
<li><a href="{!! route('apply.applicants.unmatched') !!}">Unmatched</a></li>