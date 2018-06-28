@extends('layouts.master')
@extends('layouts.login')

{{-- Content --}}
@section('content')
<div class="tck-well col-md-8 col-md-offset-2 bg-white spacer-top-3x">
    <h1>Reset Password</h1>
    @include('partials/_messages')
    {{ Form::open( ['route' => 'users.resetpassword', 'class' => 'form-horizontal' ] ) }}

        <div class="form-group" for="email">
            <label class="col-md-2 control-label" for="email">Email</label>
            <div class="col-md-10">
                {{ Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => "Email" ] ) }}
                @include('partials/forms/_error', [ 'field' => '' ] )
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                {{ Form::submit('Reset Password', array('name' => 'submit', 'class' => 'button button-secondary')) }}
            </div>
        </div>
    {{ Form::close() }}
</div>

@stop