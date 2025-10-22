@extends('layouts.app')
@section('title', __('Article list'))
@section('content')
    <h2>@lang('Article list')</h2>
    
    @auth
        <div class="actions" style="margin-bottom: var(--rythme-base);">
            <a href="{{ route('article.create') }}" class="btn btn-primaire">@lang('Create article')</a>
        </div>
    @endauth

    <div class="liste-articles">
        @forelse($articles as $article)
            <div class="carte-article">
                <h3>{{ $article['titre'] }}</h3>
                
                <div class="meta-article">
                    <span class="auteur">@lang('Author') : {{ $article['etudiant_nom'] }}</span>
                    <span class="date">@lang('Created at') : {{ $article['created_at'] }}</span>
                </div>
                
                <div class="contenu-article">
                    {{ $article['contenu'] }}
                </div>
                
                @auth
                    @if($article['etudiant_id'] == Auth::user()->etudiant->id)
                        <div class="actions">
                            <a class="btn btn-secondaire" href="{{ route('article.edit', $article['id']) }}">@lang('Modify')</a>
                            <form action="{{ route('article.destroy', $article['id']) }}" method="post" style="display:inline-block;">
                                @csrf
                                @method('delete')
                                <button type='submit' class='btn btn-primaire'>@lang('Delete')</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @empty
            <div class='alert'>@lang('No articles to display.')</div>
        @endforelse
    </div>
@endsection
