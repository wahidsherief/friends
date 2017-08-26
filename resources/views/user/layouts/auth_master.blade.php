<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>HappyMe</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/flat-admin.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        <!-- Theme -->
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/theme/blue-sky.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/theme/blue.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/theme/red.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/theme/yellow.css') }}">

    </head>
    <body>
        <div class="">
	        <div class="" id='app'>
                <div class="app app-default">
                <div class="app-container app-login">
                <div class="flex-center">
                    <div class="app-header"></div>
                        <div class="app-body">
                            <div class="loader-container text-center">
                                <div class="icon">
                                    <div class="sk-folding-cube">
                                        <div class="sk-cube1 sk-cube"></div>
                                        <div class="sk-cube2 sk-cube"></div>
                                        <div class="sk-cube4 sk-cube"></div>
                                        <div class="sk-cube3 sk-cube"></div>
                                    </div>
                                </div>
                                <div class="title">Logging in...</div>
                            </div>
                            <div class="app-block">
                                @yield('contents')
                            </div>
                        </div>
                        <div class="app-footer">
                        </div>
                    </div>
                </div>
                </div>
	        </div>
        </div>

{{--         <script type="text/javascript" src="{{ asset('user/js/vue.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/vue-strap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/vue-strap-lang.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/isMobileBrowser.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/vendor.js') }}"></script> --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
