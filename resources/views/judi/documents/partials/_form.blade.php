<div class="form-group">
    {!! Form::label('Title') !!}
    {!! Form::text('title', isset($document->title) ? $document->title : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'title' ] )
</div>

<div class="form-group">
    {!! Form::label('Procedure Number') !!}
    {!! Form::text('number', isset($document->number) ? $document->number : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'number' ] )
</div>

<div class="form-group">
    {!! Form::label('Link') !!}
    {!! Form::text('url', isset($document->url) ? $document->url : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'url' ] )
</div>

{!! Form::submit($submit, array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
