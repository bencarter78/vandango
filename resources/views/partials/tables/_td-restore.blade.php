@if( $currentUser->hasAccess($access) )
    <td class="text-center">
        <div class="actions">
            <a class="btn btn-secondary btn-xs" href="{!! URL::route($route, $model->id) !!}">Restore</a>
        </div>
    </td>
@endif