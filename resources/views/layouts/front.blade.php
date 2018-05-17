<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xml:lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="keywords" content="">
    
    <meta name="theme-color" content="#e0e0e0">
    <meta name="msapplication-navbutton-color" content="#e0e0e0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/vnd.microsoft.icon" href="">
    <link rel="canonical" href="">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/slider.css')}}">
    <link rel="stylesheet" href="{{asset('css/bundle.min.css')}}">

</head>
<body id="nobody_id" class="not-ie" 
{{-- oncontextmenu="return false;" --}}
>
    @include('layouts.front.menu')
    <div id="mm-1" class="mm-page mm-slideout">
        <div class="remodal-bg remodal-is-closed">
            @include('layouts.front.header')
            @yield('content')
        </div>
    </div>
    @include('layouts.front.footer')
    @if(Auth::check() && Auth::user()->needActivation())
        @include('layouts.front.need_activation')
    @endif
    @if(!Auth::check())
        @include('front.auth_modal')
    @endif
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mmenu.min.js') }}"></script>
    <script src="{{ asset('js/remodal.min.js') }}"></script>
    <script src="{{ asset('js/css3-mediaqueries.min.js') }}"></script>
    <script src="{{ asset('js/actions.min.js') }}"></script>
    <script src="{{ asset('js/html5.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    @stack('scripts')
    <script src="{{ asset('js/sweetalert2.all.js')}}"></script>
    <script src='{{ asset('js/form.js') }}'></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-46535603-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-46535603-3');
    </script>

</body>
</html>
