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
        'titre_en' => __('Enter English title'),
        'contenu_en' => __('Enter English content'),
        'titre_fr' => __('Enter French title'),
        'contenu_fr' => __('Enter French content')
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

        Article::create([
            'titre' => $titre,
            'contenu' => $contenu,
            'etudiant_id' => $etudiant_id
        ]);

        return redirect()->route('article.index')->with('success', __('Article created successfully'));
    }

    /**
     * Afficher le formulaire de modification de l'article spécifié.
     */
    public function edit(Article $article)
    {   
        if ($article->etudiant_id !== Auth::user()->etudiant->id) {
        return redirect()->route('article.index')->with('error', __('Unauthorized to edit this article'));
        }

        return view('article.edit', ['article' => $article]);
    }

    /**
     * Mettre à jour l'article spécifié dans le stockage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
        'titre_en' => 'required|min:3|max:255',
        'contenu_en' => 'required',
        'titre_fr' => 'required_with:contenu_fr|nullable|min:3|max:255',
        'contenu_fr' => 'required_with:titre_fr',
    ], [], [
        'titre_en' => __('Enter English title'),
        'contenu_en' => __('Enter English content'),
        'titre_fr' => __('Enter French title'),
        'contenu_fr' => __('Enter French content')
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
                     ->with('success', __('Article updated successfully'));
    }

    /**
     * Supprimer l'article spécifié du stockage.
     */
    public function destroy(Article $article)
    {   
        if ($article->etudiant_id !== Auth::user()->etudiant->id) {
        return redirect()->route('article.index')->with('error', __('Unauthorized to delete this article'));
        }

        $article->delete();

        return redirect()->route('article.index')->with('success', __('Article deleted successfully'));
    }
}