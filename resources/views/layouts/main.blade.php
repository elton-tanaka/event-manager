<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/4feaf0ed82.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" id="navbar">
                <div class="container-fluid">
                    <a href="/" class="navbar-brand">
                        <img src="/img/logo.png" alt="Events">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">{{__('Home')}}
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="/events/create" class="nav-link">{{__('Create Event')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link">{{__('My Events')}}</a>
                            </li>
                            <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout"
                                    class="nav-link"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    Logout
                                </a>
                            </form>
                        </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="/login" class="nav-link">{{__('Login')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link">{{__('Register')}}</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            <div class="container-fluid">
            <div class="row">
                @if(session('success'))
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>
            </div>
        </main>
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    </body>
    <footer>
        <p>Events Manager&copy; 2023</p>
    </footer>
</html>
