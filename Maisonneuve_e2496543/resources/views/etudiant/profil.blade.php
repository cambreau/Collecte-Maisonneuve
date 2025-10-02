@extends('layouts.app')
@section('title', 'Profil étudiant')
@section('content')

    <h2>Profil de l'étudiant</h2>

    <div class="carte-etudiants">
        <h3>{{ $etudiant->nom }}</h3>
        <ul>
            <li><strong>Email :</strong> {{ $etudiant->email }}</li>
            <li><strong>Téléphone :</strong> {{ $etudiant->telephone }}</li>
            <li><strong>Adresse :</strong> {{ $etudiant->adresse }}</li>
            <li><strong>Date de naissance :</strong> {{ $etudiant->date_naissance }}</li>
            <li><strong>Ville :</strong>
                @foreach($villes as $ville)
                    @if($ville->id == $etudiant->ville)
                        {{ $ville->ville }}
                        @break
                    @endif
                @endforeach
            </li>
        </ul>
    </div>

    <div class="actions">
        <a href="{{ route('etudiant.pageModifier', $etudiant->id) }}" class="btn btn-secondaire">Modifier</a>

        <form action="{{ route('etudiant.supprimer', $etudiant->id) }}" method="post" style="display:inline-block; margin-left: var(--rythme-serre);">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-primaire" onclick="return confirm('Supprimer cet étudiant ?');">Supprimer</button>
        </form>
    </div>

@endsection

