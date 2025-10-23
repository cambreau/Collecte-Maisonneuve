<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'nom_fichier',
        'chemin_fichier',
        'type_fichier',
        'taille_fichier',
        'etudiant_id'
    ];

    /**
     * Relation avec l'étudiant
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    /**
     * Titre (multilingue)
     */
    protected function titre(): Attribute
    {
        return Attribute::make(
            get: fn($valeur) => json_decode($valeur, true),
            set: fn($valeur) => json_encode($valeur)
        );
    }

    /**
     * Formater la taille du fichier pour l'affichage
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->taille_fichier;
        
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    /**
     * Vérifier si l'utilisateur peut modifier/supprimer ce document
     */
    public function canBeModifiedBy($userId)
    {
        return $this->etudiant_id === $userId;
    }
}
