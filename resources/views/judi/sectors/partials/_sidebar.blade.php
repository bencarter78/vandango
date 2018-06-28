<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<i class="fa fa-fw fa-slideshare"></i>
			{!! $sector->name !!}
		</h4>
	</div>

	<ul class="list-group">
		<li class="list-group-item {!! isActiveTab(Request::segment(4), 'planned') !!}">
			<i class="fa fa-fw fa-calendar"></i>
			<a href="{!! URL::route('judi.sectors.planned', [$sector->id]) !!}">Planned Assessments</a>
		</li>

		<li class="list-group-item {!! isActiveTab(Request::segment(4), 'submitted') !!}">
			<i class="fa fa-fw fa-check"></i>
			<a href="{!! URL::route('judi.sectors.submitted', [$sector->id]) !!}">Submitted Assessments</a>
		</li>

		<li class="list-group-item {!! isActiveTab(Request::segment(4), 'staff') !!}">
			<i class="fa fa-fw fa-users"></i>
			<a href="{!! URL::route('judi.sectors.staff', $sector->id) !!}">Staff</a>
		</li>
	</ul>
</div>