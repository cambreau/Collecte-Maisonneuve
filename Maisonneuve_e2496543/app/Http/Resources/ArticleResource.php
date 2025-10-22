<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transforme la ressource en tableau.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Décoder le JSON pour titre et contenu
        $titre = is_string($this->titre) ? json_decode($this->titre, true) : $this->titre;
        $contenu = is_string($this->contenu) ? json_decode($this->contenu, true) : $this->contenu;
        
        return [
            'id' => $this->id,
            'titre' => isset($titre[app()->getLocale()]) ? $titre[app()->getLocale()] : $titre['en'],
            'contenu' => isset($contenu[app()->getLocale()]) ? $contenu[app()->getLocale()] : $contenu['en'],
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'etudiant_nom' => $this->etudiant->nom,
            'etudiant_id' => $this->etudiant_id,
        ];
    }
}
