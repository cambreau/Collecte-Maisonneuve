@extends('layouts.app')
@section('title', __('Upload Document'))
@section('content')
    <h2>@lang('Upload Document')</h2>

    <form class="formulaire" action="{{ route('document.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="champ">
            <label for="titre_en">@lang('Title (English)')</label>
            <input type="text" id="titre_en" name="titre_en" value="{{ old('titre_en') }}" required 
                   placeholder="Ex: Laravel Documentation">
            @error('titre_en')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="titre_fr">@lang('Title (French)')</label>
            <input type="text" id="titre_fr" name="titre_fr" value="{{ old('titre_fr') }}" required 
                   placeholder="Ex: Documentation Laravel">
            @error('titre_fr')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="document">@lang('Document')</label>
            <input type="file" id="document" name="document" required 
                   accept=".pdf,.zip,.doc,.docx">
            <small class="help-text">@lang('Accepted formats: PDF, ZIP, DOC, DOCX. Maximum size: 10MB')</small>
            @error('document')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primaire" type="submit">@lang('Upload Document')</button>
    </form>

    <div class="actions-retour">
        <a href="{{ route('document.index') }}" class="btn btn-secondaire">@lang('Back to Documents')</a>
    </div>
@endsection
