@if( $currentUser->hasAccess($access) )
    <td class="text-center">
        <div class="actions">
            <a class="btn btn-circle btn-primary btn-xs" name="edit" id="edit_{!! $model->id !!}" href="{!! URL::route($route, $model->id) !!}">
                <i class="fa fa-pencil"></i>
            </a>
            <a class="btn btn-circle btn-danger btn-xs" id="delete_{!! $model->id !!}" role="button" data-target="#modal{!! $model->id !!}" data-toggle="modal">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </td>
@endif