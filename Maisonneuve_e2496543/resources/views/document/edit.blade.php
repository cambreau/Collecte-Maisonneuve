@extends('layouts.app')
@section('title', __('Edit Document'))
@section('content')
    <h2>@lang('Edit Document')</h2>

    <form class="formulaire" action="{{ route('document.update', $document) }}" method="post">
        @csrf
        @method('PUT')

        <div class="champ">
            <label for="titre_en">@lang('Title (English)')</label>
            <input type="text" id="titre_en" name="titre_en" value="{{ old('titre_en', $document->titre['en'] ?? '') }}" required 
                   placeholder="Ex: Laravel Documentation">
            @error('titre_en')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="titre_fr">@lang('Title (French)')</label>
            <input type="text" id="titre_fr" name="titre_fr" value="{{ old('titre_fr', $document->titre['fr'] ?? '') }}" required 
                   placeholder="Ex: Documentation Laravel">
            @error('titre_fr')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label>@lang('Current File')</label>
            <div class="file-info">
                <strong>{{ $document->nom_fichier }}</strong>
                <br>
                <small>@lang('Type'): {{ strtoupper($document->type_fichier) }} | @lang('Size'): {{ $document->formatted_size }}</small>
            </div>
        </div>

        <button class="btn btn-primaire" type="submit">@lang('Update Document')</button>
    </form>

    <div class="actions-retour">
        <a href="{{ route('document.index') }}" class="btn btn-secondaire">@lang('Back to Documents')</a>
    </div>
@endsection
