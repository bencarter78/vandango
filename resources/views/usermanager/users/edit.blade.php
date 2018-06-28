@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="cols-xs-12 col-sm-3 col-md-3 spacer-bottom-2x">
			@include('usermanager/partials/_sidebar')
		</div>

		<div class="cols-xs-12 col-sm-9 col-md-9">
			<div class="tab-content">
				<div class="tab-pane {!! getActiveTab('general', true) !!}" id="general">@include('usermanager/partials/_general')</div>
				<div class="tab-pane {!! getActiveTab('password') !!}" id="password">@include('usermanager/partials/_password')</div>

				@if ( $currentUser->hasAccess('hr') || isLineManager( $currentUser->id, $user ) )
					<div class="tab-pane {!! getActiveTab('hr') !!}" id="hr">@include('usermanager/partials/_hr')</div>
					<div class="tab-pane {!! getActiveTab('roles') !!}" id="roles">@include('usermanager/partials/_roles')</div>
					<div class="tab-pane {!! getActiveTab('departments') !!}" id="departments">@include('usermanager/partials/_departments')</div>
					<div class="tab-pane {!! getActiveTab('sectors') !!}" id="sectors">@include('usermanager/partials/_sectors')</div>
				@endif

				@if ( $currentUser->hasAccess('hr') )
					<div class="tab-pane {!! getActiveTab('groups') !!}" id="groups">@include('usermanager/partials/_groups')</div>
				@endif
			</div>
		</div>

	</div>

@stop