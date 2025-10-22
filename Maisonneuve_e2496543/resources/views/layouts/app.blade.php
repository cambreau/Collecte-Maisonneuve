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
                <!-- Éléments de navigation à gauche -->
                <div class="nav-left">
                    <li class="navigation__item"><a href="{{ route('article.index') }}">@lang('Article list')</a></li>
                    @auth
                        <li class="navigation__item"><a href="{{ route('article.create') }}">@lang('Create article')</a></li>
                        <li class="navigation__item"><a href="{{ route('etudiant.profil', $etudiant->id) }}">@lang('Profile')</a></li>
                        <li class="navigation__item"><a href="{{ route('logout') }}">@lang('Logout')</a></li>
                    @endauth
                    @guest
                        <li class="navigation__item"><a href="{{ route('login') }}">@lang('Login')</a></li>
                    @endguest
                </div>
                
                <!-- Dropdown des langues à droite -->
                <div class="nav-right">
                    <li class="navigation__item dropdown-menu">
                        <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('lang', 'en') }}">EN</a>
                        <a class="dropdown-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('lang', 'fr') }}">FR</a>
                    </li>
                </div>
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

