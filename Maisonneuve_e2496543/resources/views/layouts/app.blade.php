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
                <img src="{{ asset('images/logo.jpg') }}" alt="@lang('Maisonneuve')">
            </a>
        </picture>
        <h1>@lang('Student Zone')</h1>
        @auth
            <nav class="navigation">
                <ul class="navigation__menu">
                    <!-- Éléments de navigation à gauche -->
                    <div class="nav-gauche">
                        <li class="navigation__item"><a href="{{ route('article.index') }}">@lang('Article list')</a></li>
                        <li class="navigation__item"><a href="{{ route('document.index') }}">@lang('Document')</a></li>
                        <li class="navigation__item"><a href="{{ route('etudiant.listeEtuidants') }}">@lang('Student list')</a></li>
                        <li class="navigation__item"><a href="{{ route('etudiant.profil', Auth::user()->etudiant->id) }}">@lang('Profile')</a></li>
                        <li class="navigation__item"><a href="{{ route('logout') }}" class="btn btn-danger">@lang('Logout')</a></li>
                    </div>
                    
                    <!-- Dropdown des langues à droite -->
                    <div class="nav-droite">
                        <li class="navigation__item menu-deroulant">
                            <a class="element-menu {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('lang', 'en') }}">EN</a>
                            <a class="element-menu {{ app()->getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('lang', 'fr') }}">FR</a>
                        </li>
                    </div>
                </ul>
            </nav>
        @endauth
    </header>

    <main class="site-main container">
        @yield('content')
    </main>

    <footer class="footer">
        <p>© 2025 @lang('Maisonneuve'). @lang('All rights reserved').</p>
    </footer>
</body>
</html>

