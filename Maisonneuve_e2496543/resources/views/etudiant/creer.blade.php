@extends('layouts.app')
@section('title', __('Create a student'))
@section('content')
    <h2>@lang('Create a student')</h2>

    <form class="formulaire" action="{{ route('etudiant.creer') }}" method="post">
        @csrf

        <div class="champ">
            <label for='nom'>@lang('Name')</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Ex: Camille Breau">
            @error('nom')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='adresse'>@lang('Address')</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" placeholder="Ex: 1234 Rue Saint-Denis, Montréal">
            @error('adresse')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='telephone'>@lang('Phone')</label>
            <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" placeholder="Ex: 514-555-1234">
            @error('telephone')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='email'>@lang('Email')</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="ex: zoneEtudiant@example.com">
            @error('email')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

      <div class="champ">
            <label for='password'>@lang('Password')</label>
            <input type="password" id="password" name="password" required placeholder="@lang('8 characters minimum')">
            @error('password')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='password_confirmation'>@lang('Confirm password')</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="@lang('Confirm password')">
        </div> 

        <div class="champ">
            <label for='date_naissance'>@lang('Birth date')</label>
            <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
            @error('date_naissance')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for='ville'>@lang('City')</label>
            <select id="ville" name="ville" required>
                <option value="">@lang('Choose a city')</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" {{ old('ville') == $ville->id ? 'selected' : '' }}>{{ $ville->ville }}</option>
                @endforeach
            </select>
            @error('ville')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <button class='btn btn-primaire' type='submit'>@lang('Create')</button>
    </form>
@endsection

