<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'User Model Activity') }}</title>

    <!-- CSS -->
    <link href="{{ asset('vendor/user-model-activity/css/user-model-activity-bootstrap.css') }}" rel="stylesheet">

    <!-- JavaScript -->
    <script src="{{ asset('vendor/user-model-activity/js/user-model-activity-bootstrap.min.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
