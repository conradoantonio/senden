<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pace-theme-flash.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/jquery.scrollbar.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/animate.min.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/custom-icon-set.css')}}"  type="text/css" media="screen"/>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/breakpoints.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/jquery-block-ui/jqueryblockui.js') }}" type="text/javascript"></script> 

    <script src="{{ asset('js/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}" type="text/javascript"></script>  
    <script src="{{ asset('js/plugins/jquery-numberAnimate/jquery.animateNumbers.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->     

    <!-- BEGIN CORE TEMPLATE JS --> 
    <script src="{{ asset('js/core.js') }}" type="text/javascript"></script>
</body>
</html>
