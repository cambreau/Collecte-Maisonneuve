<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'ville',
    ];

    /**
     * Relation : une ville peut avoir plusieurs étudiants
     */
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class, 'ville');
    }

}
