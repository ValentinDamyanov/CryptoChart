<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') | {{__('common.app_name')}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    {{-- Include navar --}}
    <div class="container-fluid">
        <div class="row">
            {{-- Include sidebar --}}
            <main role="main" class="col-md-12 col-lg-12 col-xl-12 ml-sm-auto  px-md-4">
                @yield('content')

                <flash-message :position="'right bottom'"></flash-message>
            </main>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}" defer></script>
</body>
</html>
