@extends('layouts.app')
@section('title', __('Create article'))
@section('content')
    <h2>@lang('Create article')</h2>

    <form class="formulaire" action="{{ route('article.store') }}" method="post">
        @csrf

        <div class="champ">
            <label for="titre_en">@lang('Title') (@lang('English'))</label>
            <input type="text" id="titre_en" name="titre_en" value="{{ old('titre_en') }}" required placeholder="@lang('Enter English title')">
            @error('titre_en')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="contenu_en">@lang('Content') (@lang('English'))</label>
            <textarea id="contenu_en" name="contenu_en" rows="5" required placeholder="@lang('Enter English content')">{{ old('contenu_en') }}</textarea>
            @error('contenu_en')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="titre_fr">@lang('Title') (@lang('French'))</label>
            <input type="text" id="titre_fr" name="titre_fr" value="{{ old('titre_fr') }}" placeholder="@lang('Enter French title')">
            @error('titre_fr')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <div class="champ">
            <label for="contenu_fr">@lang('Content') (@lang('French'))</label>
            <textarea id="contenu_fr" name="contenu_fr" rows="5" placeholder="@lang('Enter French content')">{{ old('contenu_fr') }}</textarea>
            @error('contenu_fr')
                <div class="erreur">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primaire" type="submit">@lang('Create')</button>
    </form>
@endsection
