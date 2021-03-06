<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>Friends</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/myapp.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/flat-admin.css') }}">

        <!-- Theme -->
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/theme/blue-sky.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/theme/blue.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/theme/red.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/theme/yellow.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <style type="text/css">
            @yield('style')
        </style>

        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
                ]) !!};
        </script>

    </head>
    <body>
        <div class="row" id='app'>
	        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-xl-4 col-xl-offset-5">
                <div class="app app-default">
                    
                    <div class="app-container" style="padding-left: 0px">
                        @yield('contents')
                    </div>

                </div>
	        </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/axios.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/vue.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/isMobileBrowser.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/myapp.js') }}"></script>
        @yield('scripts')
    </body>
</html>
