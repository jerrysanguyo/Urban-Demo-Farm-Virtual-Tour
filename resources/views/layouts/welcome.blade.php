<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Haven - Embrace Nature</title>
    @if (Request::is('login'))
        @vite(['resources/css/app.css', 'resources/css/login.css'])
    @else
        @vite(['resources/css/app.css', 'resources/css/welcome.css'])
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    @if (!Request::is('login'))
        @include('layouts.components.nav')
    @endif
    <!-- Page Content -->
    <div>
        @yield('content')
    </div>
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>