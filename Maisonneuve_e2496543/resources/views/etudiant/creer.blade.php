@extends('layouts.app')
@section('title', 'Créer un étudiant')
@section('content')
    <h2>Créer un étudiant</h2>

    <form class="formulaire" action="{{ route('etudiant.creer') }}" method="post">
        @csrf

        <div class="champ">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Ex: Camille Breau">
            @error('nom')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" placeholder="Ex: 1234 Rue Saint-Denis, Montréal">
            @error('adresse')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" placeholder="Ex: 514-555-1234">
            @error('telephone')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="ex: zoneEtudiant@example.com">
            @error('email')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

      <div class="champ">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required placeholder="8 caractères minimum">
            @error('password')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirmez le mot de passe">
        </div> 

        <div class="champ">
            <label for="date_naissance">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
            @error('date_naissance')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="ville">Ville</label>
            <select id="ville" name="ville" required>
                <option value="">-- Choisir une ville --</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" {{ old('ville') == $ville->id ? 'selected' : '' }}>{{ $ville->ville }}</option>
                @endforeach
            </select>
            @error('ville')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primaire" type="submit">Créer</button>
    </form>
@endsection

