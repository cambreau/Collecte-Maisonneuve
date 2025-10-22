<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('Maisonneuve'))</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <picture class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="@lang('Maisonneuve')">
            </a>
        </picture>
        <h1>@lang('Student Zone')</h1>
        <nav class="navigation">
            <ul class="navigation__menu">
                @auth
                    <li class="navigation__item"><a href="{{ route('etudiant.profil', $etudiant->id) }}">@lang('Profile')</a></li>
                    <li class="navigation__item"><a href="{{ route('logout') }}">@lang('Logout')</a></li>
                @endauth
                @guest
                    <li class="navigation__item"><a href="{{ route('login') }}">@lang('Login')</a></li>
                @endguest
            </ul>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" aria-current="true" href="{{ route('lang', 'en') }}">@lang('English')</a></li>
                <li><a class="dropdown-item" href="{{ route('lang', 'fr') }}">@lang('French')</a></li>
            </ul>
        </nav>
    </header>

    <main class="site-main container">
        @if(session('succes'))
            <div class="succes" role="alert">
                 {{ session('succes')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="footer">
        <p>© 2025 @lang('Maisonneuve'). @lang('All rights reserved').</p>
    </footer>
</body>
</html>

