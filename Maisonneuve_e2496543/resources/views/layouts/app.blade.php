<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Maisonneuve')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <picture class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Maisonneuve">
            </a>
        </picture>
        <h1>Zone Étudiante</h1>
        <nav class="navigation">
            <ul class="navigation__menu">
                @auth
                    <li class="navigation__item"><a href="{{ route('etudiant.profil', $etudiant->id) }}">Profil</a></li>
                    <li class="navigation__item"><a href="{{ route('logout') }}">Déconnexion</a></li>
                @endauth
                @guest
                    <li class="navigation__item"><a href="{{ route('login') }}">Connexion</a></li>
                @endguest
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
        <p>© 2025 Maisonneuve. Tous droits réservés.</p>
    </footer>
</body>
</html>

