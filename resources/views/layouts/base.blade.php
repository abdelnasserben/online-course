<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dabel | Cours en ligne</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

@php
    $routeName = Route::currentRouteName();
@endphp

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => $routeName === 'home']) aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => str_starts_with($routeName, 'courses'),
                        ]) href="{{ route('courses.index') }}">Courses</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => str_starts_with($routeName, 'trainers'),
                        ]) href="{{ route('trainers.index') }}">Trainers</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => str_starts_with($routeName, 'premium'),
                        ]) href="{{ route('premium.index') }}">Premium</a>
                    </li>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => $routeName === 'login']) href="{{ route('login') }}">Se connecter</a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => $routeName === 'register']) href="{{ route('register') }}">S'inscrire</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => $routeName === 'dashboard']) href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a @class([
                                    'nav-link',
                                    'active' => str_starts_with($routeName, 'admin'),
                                ]) href="{{ route('admin.index') }}">Administration</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
