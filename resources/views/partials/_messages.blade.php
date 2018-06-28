@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p><i class="fa fa-warning"></i> <strong>{!! Session::get('error') !!}</strong></p>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p><i class="fa fa-check-circle"></i> <strong>{!! Session::get('success') !!}</strong></p>
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p><i class="fa fa-info-circle"></i> <strong>{!! Session::get('info') !!}</strong></p>
    </div>
@endif

@if(Session::has('status'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p><i class="fa fa-info-circle"></i> <strong>{!! Session::get('status') !!}</strong></p>
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p><i class="fa fa-warning"></i> <strong>{!! Session::get('warning') !!}</strong></p>
    </div>
@endif