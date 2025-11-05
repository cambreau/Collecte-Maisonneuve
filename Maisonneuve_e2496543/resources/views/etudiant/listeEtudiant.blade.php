@extends('layouts.app')
@section('title', __('Student list'))
@section('content')
    <h2>@lang('Student list')</h2>
    <div class="liste-etudiants">
        @forelse($etudiants as $etudiant)
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
                @if(Auth::check() && Auth::user()->etudiant && Auth::user()->etudiant->id == $etudiant->id)
                <div class="actions">
                    <a class='btn btn-secondaire' href='{{ route('etudiant.pageModifier', $etudiant->id) }}'>@lang('Modify')</a>
                    <form action="{{ route('etudiant.supprimer', $etudiant->id) }}" method="post" class="formulaire-inline-etudiant">
                        @csrf
                        @method('delete')
                        <button type='submit' class='btn btn-primaire'>@lang('Delete')</button>
                    </form>
                </div>
                @endif
            </div>
        @empty
            <div class='alert'>@lang('No students to display.')</div>
        @endforelse
    </div>
@endsection

