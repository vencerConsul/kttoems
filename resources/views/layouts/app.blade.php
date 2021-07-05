<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"/>
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @yield('logincss')
    @yield('registercss')
    @yield('adminDashboardStyle')
    @yield('usersurvey')
    @yield('userdashboard')
    @yield('thankyou')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    @if(Route::current()->getName() != 'calendar' && Route::current()->getName() != 'evaluation' && Route::current()->getName() != 'survey')
    <script src="{{ asset('/js/app.js') }}" defer></script>
    @endif
    @yield('fullcalendarscript')
    @yield('evaluationScript')
    @yield('galleryScript')
    @yield('userdashboard')
</body>
</html>
