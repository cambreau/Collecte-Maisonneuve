@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <h2>Se connecter</h2>

    @if(session('succes'))
        <div class="alerte">{{ session('succes') }}</div>
    @endif

    <ul>
        @foreach($errors->all() as $error)
            <li class="erreur">{{ $error }}</li>
        @endforeach
    </ul>   


    <form class="formulaire" method="post" action="{{ route('login') }}">
        @csrf

        <div class="champ">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ex: zoneEtudiant@example.com">
        </div>
        <div class="champ">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe">
        </div>

        <button class="btn btn-primaire" type="submit">Se connecter</button>
    </form>

    <p style="margin-top: var(--rythme-base);">Pas encore de profil ?
        <a class="btn btn-secondaire" href="{{ route('etudiant.pageCreation') }}" style="margin-left: var(--rythme-serre);">Créer un étudiant</a>
    </p>
@endsection