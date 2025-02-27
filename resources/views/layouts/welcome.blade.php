<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Haven - Embrace Nature</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-B0dONUtb.css') }}">
    <script src="{{ asset('build/assets/app--KqnoJvy.js') }}"></script>
    @if (Request::is('login') || Request::is('/'))
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

</head>

<body>
    @if (!Request::is('login'))
    @include('layouts.components.nav')
    @endif
    <!-- Page Content -->
    <div>
        @yield('content')
    </div>
    @stack('scripts')
</body>

</html>