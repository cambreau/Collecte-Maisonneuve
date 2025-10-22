<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ArticleResource;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'contenu','etudiant_id'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    protected function titre(): Attribute
    {
        return Attribute::make(
            get: fn($valeur) => json_decode($valeur, true),
            set: fn($valeur) => json_encode($valeur)
        );
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn($valeur) => json_decode($valeur, true),
            set: fn($valeur) => json_encode($valeur)
        );
    }

    public static function articles(){
        $article = ArticleResource::collection(Article::all()->sortByDesc('created_at'))->resolve();
        $trie = collect($article)->sortBy('Article')->values();
        return $trie->all();
    }
}
