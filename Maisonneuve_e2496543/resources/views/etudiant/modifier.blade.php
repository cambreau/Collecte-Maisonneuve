@extends('layouts.app')
@section('title', __('Modify student'))
@section('content')
    <h2>@lang('Modify student')</h2>

    <form class="formulaire" action="{{ route('etudiant.modifier', $etudiant->id) }}" method="post">
        @method('put')
        @csrf

        <div class="champ">
            <label for='nom'>@lang('Name')</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}">
            @error('nom')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='adresse'>@lang('Address')</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $etudiant->adresse) }}">
            @error('adresse')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='telephone'>@lang('Phone')</label>
            <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}">
            @error('telephone')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='date_naissance'>@lang('Birth date')</label>
            <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance) }}">
            @error('date_naissance')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='ville'>@lang('City')</label>
            <select id="ville" name="ville">
                <option value="">@lang('Choose a city')</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" {{ old('ville', $etudiant->ville) == $ville->id ? 'selected' : '' }}>{{ $ville->ville }}</option>
                @endforeach
            </select>
            @error('ville')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <button class='btn' type='submit'>@lang('Save')</button>
    </form>
@endsection('content')

