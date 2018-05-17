<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">
    <title>{{ config('app.name', 'TV') }} Admin</title>

    <!-- Styles -->
    <link href="{{asset('admin/css/style.default.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/jquery.datatables.css')}}" rel="stylesheet">
    @stack('styles')

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    
</head>
<body>
    <div id="preloader">
        <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
    </div>
    <section>
        @include('layouts.admin_sidebar')
        <div class="pageheader">
          <h2>@yield('content_title')</h2>
        </div>

        
        <div class="contentpanel">
            @yield('content')
        </div>    
    </section>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('admin/js/jquery-1.11.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery-ui-1.10.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/modernizr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery.sparkline.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/toggles.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery.datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/retina.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery.cookies.js') }}"></script>

    {{-- <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
 --}}
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/custom.js') }}"></script>
    @stack('scripts')
</body>
</html>
