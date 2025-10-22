<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleRessource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    /**
     * Afficher la liste des ressources.
     */
    public function index()
    {
        $articles = Article::articles();
    return view('article.index',compact('articles'));
    }

    /**
     * Afficher le formulaire de création d'une nouvelle ressource.
     */
    public function create()
    {   
        
        return view('article.create');
    }

    /**
     * Enregistrer une nouvelle ressource dans le stockage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'titre_en' => 'required|min:3|max:255',
            'contenu_en' => 'required',
            'titre_fr' => 'required_with:contenu_fr|nullable|min:3|max:255',
            'contenu_fr' => 'required_with:titre_fr',
        ],[], [
        'titre_en' => trans('lang.article_titre_english'),
        'contenu_en' => trans('lang.article_contenu_english'),
        'titre_fr' => trans('lang.article_titre_french'),
        'contenu_fr' => trans('lang.article_contenu_french')
        ]);
       
        $titre = array_filter([
            'en' => $request->titre_en,
            'fr' => $request->titre_fr
        ]);

        $contenu = array_filter([
            'en' => $request->contenu_en,
            'fr' => $request->contenu_fr
        ]);

        $etudiant_id = Auth::user()->etudiant->id;

        // dd($titre, $contenu, $etudiant_id);

        Article::create([
            'titre' => $titre,
            'contenu' => $contenu,
            'etudiant_id' => $etudiant_id
        ]);

        return redirect()->route('Article.index')->with('success', trans('lang.message_success_create_article'));
    }

    /**
     * Afficher la ressource spécifiée.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Afficher le formulaire de modification de la ressource spécifiée.
     */
    public function edit(Article $article)
    {   
        if ($article->etudiant_id !== Auth::user()->etudiant->id) {
        return redirect()->route('article.index')->with('error', trans('lang.message_unauthorized_edit'));
        }

        return view('article.edit', ['article' => $article]);
    }

    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
        'titre_en' => 'required|min:3|max:255',
        'contenu_en' => 'required',
        'titre_fr' => 'required_with:contenu_fr|nullable|min:3|max:255',
        'contenu_fr' => 'required_with:titre_fr',
    ], [], [
        'titre_en' => trans('lang.article_titre_english'),
        'contenu_en' => trans('lang.article_contenu_english'),
        'titre_fr' => trans('lang.article_titre_french'),
        'contenu_fr' => trans('lang.article_contenu_french')
    ]);

    $article->update([
        'titre' => array_filter([
            'en' => $request->titre_en,
            'fr' => $request->titre_fr,
        ]),
        'contenu' => array_filter([
            'en' => $request->contenu_en,
            'fr' => $request->contenu_fr,
        ]),
    ]);

    return redirect()->route('article.index', $article)
                     ->with('success', trans('lang.message_success_Article_updated'));
    }

    /**
     * Supprimer la ressource spécifiée du stockage.
     */
    public function destroy(Article $article)
    {   
        if ($article->etudiant_id !== Auth::user()->etudiant->id) {
        return redirect()->route('article.index')->with('error', trans('lang.message_unauthorized_delete'));
        }

        $article->delete();

        return redirect()->route('article.index')->with('success', trans('lang.message_success_article_deleted'));
    }
}