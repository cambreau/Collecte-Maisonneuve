@extends('layouts.app')
@section('title', __('Login'))
@section('content')
    <h2>@lang('Connect')</h2>

    @if(session('succes'))
        <div class="alerte">{{ session('succes') }}</div>
    @endif

    <ul>
        @foreach($errors->all() as $error)
            <li class="erreur">{{ $error }}</li>
        @endforeach
    </ul>   

    <form class="formulaire" method="post" action="{{ route('login') }}">
        @csrf

        <div class="champ">
            <label for="email">@lang('Email')</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ex: zoneEtudiant@example.com">
        </div>
        <div class="champ">
            <label for="password">@lang('Password')</label>
            <input type="password" id="password" name="password" placeholder="@lang('Enter your password')">
        </div>

        <button class="btn btn-primaire" type="submit">@lang('Connect')</button>
    </form>

    <p style="margin-top: var(--rythme-base);">@lang('No profile yet?')
        <a class="btn btn-secondaire" href="{{ route('etudiant.pageCreation') }}" style="margin-left: var(--rythme-serre);">@lang('Create a student')</a>
    </p>
@endsection