<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Skyblock Management - @yield('title', 'App')</title>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
