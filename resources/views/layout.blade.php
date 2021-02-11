<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Elite Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    </head>
    <body class="antialiased">
    <div class="container-fluid">
        <ul class="nav nav-pills justify-content-center p-4">
            <li class="nav-item mr-2">
                <a class="nav-link @if(str_contains(request()->path(), 'people')) active @endif" href="{{ route('people.list') }}">People</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(str_contains(request()->path(), 'organizations')) active @endif" href="{{ route('organizations.list') }}">Organizations</a>
            </li>
        </ul>
        @yield('content')
    </div>
    </body>
</html>
