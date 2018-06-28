@extends('layouts.login')
@section('content')

    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png"/>
        <p id="profile-name" class="profile-name-card"></p>
        @include('partials/_messages')
        <form class="form-horizontal form-signin" role="form" method="POST" action="{{ url('/auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <span id="reauth-email" class="reauth-email"></span>
            <input name="email" value="{{ old('email') }}" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember"> Remember me
                </label>
            </div>
            <button id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form><!-- /form -->
        <a href="{{ url('/auth/password/reset') }}">Forgot Your Password?</a>

    </div><!-- /card-container -->
@stop