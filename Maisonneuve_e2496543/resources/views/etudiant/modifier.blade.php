@extends('layouts.app')
@section('title', 'Modifier étudiant')
@section('content')
    <h2>Modifier l'étudiant</h2>

    <form class="formulaire" action="{{ route('etudiant.modifier', $etudiant->id) }}" method="post">
        @method('put')
        @csrf

        <div class="champ">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}">
            @error('nom')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $etudiant->adresse) }}">
            @error('adresse')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}">
            @error('telephone')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $etudiant->email) }}">
            @error('email')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="date_naissance">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance) }}">
            @error('date_naissance')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="ville">Ville</label>
            <select id="ville" name="ville">
                <option value="">-- Choisir une ville --</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" {{ old('ville', $etudiant->ville) == $ville->id ? 'selected' : '' }}>{{ $ville->ville }}</option>
                @endforeach
            </select>
            @error('ville')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn" type="submit">Enregistrer</button>
    </form>
@endsection('content')

