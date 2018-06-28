<div class="sub-nav panel panel-default">
    <ul class="list-group">
        <li class="list-group-item {!! getActiveTab('general', true) !!}">
            <i class="fa fa-fw fa-info"></i>
            <a href="#general" data-toggle="tab">General</a>
        </li>

        <li class="list-group-item {!! getActiveTab('password') !!}">
            <i class="fa fa-fw fa-lock"></i>
            <a href="#password" data-toggle="tab">Password</a>
        </li>

        @if ( $currentUser->hasAccess('hr') || isLineManager( $currentUser->id, $user ) )
            <li class="list-group-item {!! getActiveTab('hr') !!}">
                <i class="fa fa-fw fa-folder-open"></i>
                <a href="#hr" data-toggle="tab">HR</a>
            </li>

            <li class="list-group-item {!! getActiveTab('departments') !!}">
                <i class="fa fa-fw fa-archive"></i>
                <a href="#departments" data-toggle="tab">Departments</a>
            </li>

            <li class="list-group-item {!! getActiveTab('sectors') !!}">
                <i class="fa fa-fw fa-slideshare"></i>
                <a href="#sectors" data-toggle="tab">Sectors</a>
            </li>

            <li class="list-group-item {!! getActiveTab('roles') !!}">
                <i class="fa fa-fw fa-cog"></i>
                <a href="#roles" data-toggle="tab">Job Functions</a>
            </li>
        @endif

        @if ( $currentUser->hasAccess('hr') )
            <li class="list-group-item {!! getActiveTab('groups') !!}">
                <i class="fa fa-fw fa-users"></i>
                <a href="#groups" data-toggle="tab">Groups</a>
            </li>
        @endif
    </ul>
</div>