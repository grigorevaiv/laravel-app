<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss','resources/js/app.js','resources/css/app.css'])
    <title>@yield('title')</title>
</head>
<body>
<header class="container-fluid bg-warning text-center py-3 display-4">
    @yield('title')
</header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                @auth
                    <a class="navbar-brand" href="{{ route('dashboard') }}">Qeustions of {{ Auth::user()->name }}</a>
                    <a class="nav-link" href="{{ route('comments') }}">Comments</a>
                    <a class="nav-link" href="{{ route('dashboard_addquestion') }}">Create a new question</a>
                    <a class="nav-link" href="{{ route('dashboard_addcomment') }}">Comment a question</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </form>
                @else
                <a class="navbar-brand" href="{{ route('home') }}">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="row justify-content-md-center">
    <div class="col-md-10 text-center">
        <div class="card">
            <div class="card-header display-6">
                @yield('description')
            </div>
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>
