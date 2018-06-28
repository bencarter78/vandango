<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {!! ( isset( $pageTitle ) ) ? strip_tags($pageTitle) . ' | ' : '' !!}
        {!! Config::get('vandango.site') !!}
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id="_token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ cookie('laravel_token') }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" href="{!! asset('apple-touch-icon-precomposed.png') !!}">
    <link rel="icon" href="{!! asset('img/favicon.ico') !!}">
    <link rel="stylesheet" href="{!! mix('css/app.css') !!}">

    @yield('head')
    @stack('css')
    @yield('styles')
    @routes
</head>
<body>

<div id="app" class="wrap">
    <header>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand site-title" href="{!! URL::to('/') !!}">{!! Config::get('vandango.site') !!}</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @if(isset($nav))
                            @include( loadPackageNav($nav) )
                        @else
                            @include( loadPackageNav() )
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @include('partials.nav._subnav')
                    </ul>
                </div>
            </div>
        </div>

        @if (isset($pageTitle))
            <section id="page-title">
                <div class="container-fluid">
                    <h1>{!! $pageTitle !!}</h1>
                </div>
            </section>
        @endif
    </header>

    <div class="container-fluid spacer-top-3x">
        <vd-flash message="{{ session('flash') }}"></vd-flash>
        @if(Cache::has('global-message'))
            @include('partials/_global-messages', [
                'level' => key(Cache::get('global-message')),
                'msg' => array_values(Cache::get('global-message'))[0]
            ])
        @endif

        @include('partials/_messages')
        @yield('content')
    </div>
</div>

@include('partials._footer')
@yield('modalContent')
@stack('modalContent')

<script src="{!! mix('js/main.js') !!}"></script>

@section('scripts')
@show

@stack('scripts')

@section('js')
@show

@stack('js')

</body>
</html>