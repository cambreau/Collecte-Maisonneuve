<?php

namespace App\Http\Controllers;

/*
 * References:
 * https://laravel.com/docs/10.x/pagination
 * https://laravel.com/docs/10.x/validation#rule-file 
 * https://laravel.com/docs/10.x/validation#rule-mimes
 * https://laravel.com/docs/10.x/requests#retrieving-uploaded-files
 * https://laravel.com/docs/10.x/filesystem#file-uploads
 * https://laravel.com/docs/10.x/filesystem#file-existence
 * https://laravel.com/docs/10.x/filesystem#the-public-disk
 * https://laravel.com/docs/10.x/responses#file-downloads
 * https://laravel.com/docs/10.x/helpers#method-storage-path
 * https://laravel.com/docs/10.x/authorization#writing-policies
 * https://www.php.net/time
 * https://symfony.com/doc/current/components/http_foundation.html#managing-uploaded-files
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Afficher la liste des documents avec pagination
     */
    public function index()
    {
        $documents = Document::with('etudiant')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 documents par page

        return view('document.index', compact('documents'));
    }

    /**
     * Afficher le formulaire de création d'un nouveau document
     */
    public function create()
    {
        return view('document.create');
    }

    /**
     * Stocker un nouveau document
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre_en' => 'required|string|max:255',
            'titre_fr' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,zip,doc,docx|max:10240' 
        ]);

        // Préparer les titres multilingues
        $titre = array_filter([
            'en' => $request->titre_en,
            'fr' => $request->titre_fr
        ]);

        // Traitement du fichier
        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('documents', $filename, 'public');

        // Créer le document en base
        $document = Document::create([
            'titre' => $titre,
            'nom_fichier' => $file->getClientOriginalName(),
            'chemin_fichier' => $path,
            'type_fichier' => $file->getClientOriginalExtension(),
            'taille_fichier' => $file->getSize(),
            'etudiant_id' => Auth::user()->etudiant->id
        ]);

        return redirect()->route('document.index')->with('succes', __('Document uploaded successfully'));
    }

    /**
     * Télécharger un document
     */
    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->chemin_fichier)) {
            abort(404, 'Document not found');
        }

        return response()->download(storage_path('app/public/' . $document->chemin_fichier), $document->nom_fichier);
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Document $document)
    {
        // Vérifier que l'utilisateur peut modifier ce document
        if (!$document->canBeModifiedBy(Auth::user()->etudiant->id)) {
            abort(403, 'Unauthorized');
        }

        return view('document.edit', compact('document'));
    }

    /**
     * Mettre à jour un document
     */
    public function update(Request $request, Document $document)
    {
        // Vérifier que l'utilisateur peut modifier ce document
        if (!$document->canBeModifiedBy(Auth::user()->etudiant->id)) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'titre_en' => 'required|string|max:255',
            'titre_fr' => 'required|string|max:255'
        ]);

        // Préparer les titres multilingues
        $titre = array_filter([
            'en' => $request->titre_en,
            'fr' => $request->titre_fr
        ]);

        $document->update([
            'titre' => $titre
        ]);

        return redirect()->route('document.index')->with('succes', __('Document updated successfully'));
    }

    /**
     * Supprimer un document
     */
    public function destroy(Document $document)
    {
        // Vérifier que l'utilisateur peut supprimer ce document
        if (!$document->canBeModifiedBy(Auth::user()->etudiant->id)) {
            abort(403, 'Unauthorized');
        }

        // Supprimer le fichier physique
        Storage::disk('public')->delete($document->chemin_fichier);

        // Supprimer l'enregistrement en base
        $document->delete();

        return redirect()->route('document.index')->with('succes', __('Document deleted successfully'));
    }
}
