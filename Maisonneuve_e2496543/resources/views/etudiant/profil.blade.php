@extends('layouts.app')
@section('title', __('Student profile'))
@section('content')

    <h2>@lang('Student profile')</h2>

    <div class="carte-etudiants">
        <h3>{{ $etudiant->nom }}</h3>
        <ul>
            <li><strong>@lang('Email') :</strong> {{ $etudiant->email }}</li>
            <li><strong>@lang('Phone') :</strong> {{ $etudiant->telephone }}</li>
            <li><strong>@lang('Address') :</strong> {{ $etudiant->adresse }}</li>
            <li><strong>@lang('Birth date') :</strong> {{ $etudiant->date_naissance }}</li>
            <li><strong>@lang('City') :</strong>
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
        <a href='{{ route('etudiant.pageModifier', $etudiant->id) }}' class='btn btn-secondaire'>@lang('Modify')</a>

        <form action="{{ route('etudiant.supprimer', $etudiant->id) }}" method="post" style="display:inline-block; margin-left: var(--rythme-serre);">
            @csrf
            @method('delete')
            <button type='submit' class='btn btn-primaire'>@lang('Delete')</button>
        </form>
    </div>

@endsection

