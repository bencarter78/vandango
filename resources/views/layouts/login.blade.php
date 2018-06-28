<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login to {!! Config::get('vandango.site') !!} | {!! Config::get('vandango.creator') !!}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id="_token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" href="{!! asset('apple-touch-icon-precomposed.png') !!}">
    <link rel="icon" href="{!! asset('img/favicon.ico') !!}">
    <link rel="stylesheet" href="{!! mix('css/app.css') !!}">

    @yield('head')
    @stack('css')
    @yield('styles')
</head>

<body id="login">
<div class="container">
    <div class="logo-holder col-md-8 col-md-offset-2"><h1 class="site-title text-center">VanDango</h1></div>
</div>

<div class="container">
    @if(Cache::has('global-message'))
        <div class="row">
            <div class="col-md-4 col-md-offset-4 spacer-top-5x">
                @include('partials/_global-messages', [
                    'level' => key(Cache::get('global-message')),
                    'msg' => array_values(Cache::get('global-message'))[0]
                ])
            </div>
        </div>
    @endif

    @yield('content')
</div>

<script src="{!! mix('js/main.js') !!}"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function () {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');
</script>
</body>
</html>
