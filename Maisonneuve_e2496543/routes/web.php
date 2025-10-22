<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', [ArticleController::class, 'index'])->name('article.index');

Route::get('/etudiants', [EtudiantController::class, 'listeEtuidants'])->name('etudiant.listeEtuidants');

// Auth routes
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

// Public 
Route::get('/etudiants/pageCreation', [EtudiantController::class, 'pageCreation'])->name('etudiant.pageCreation');
Route::post('/etudiants/creer', [EtudiantController::class, 'creer'])->name('etudiant.creer');

// Articles routes
Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');

// Protégées
Route::middleware('auth')->group(function () {
    // Étudiants
    Route::get('/etudiants/profil/{etudiant}', [EtudiantController::class, 'profil'])->name('etudiant.profil');
    Route::get('/etudiants/pageModifier/{etudiant}', [EtudiantController::class, 'pageModifier'])->name('etudiant.pageModifier');
    Route::put('/etudiants/modifier/{etudiant}', [EtudiantController::class, 'modifier'])->name('etudiant.modifier');
    Route::delete('/etudiants/supprimer/{etudiant}', [EtudiantController::class, 'supprimer'])->name('etudiant.supprimer');
    
    // Articles
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
});

// Langues
Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');