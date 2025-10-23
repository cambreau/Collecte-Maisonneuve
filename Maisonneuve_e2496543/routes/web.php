<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DocumentController;

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




// Page d'accueil = connexion
Route::get('/', [AuthController::class, 'create'])->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

// Public 
Route::get('/etudiants/pageCreation', [EtudiantController::class, 'pageCreation'])->name('etudiant.pageCreation');
Route::post('/etudiants/creer', [EtudiantController::class, 'creer'])->name('etudiant.creer');

// Protégées
Route::middleware('auth')->group(function () {
    // Étudiants
    Route::get('/etudiants', [EtudiantController::class, 'listeEtuidants'])->name('etudiant.listeEtuidants');
    Route::get('/etudiants/profil/{etudiant}', [EtudiantController::class, 'profil'])->name('etudiant.profil');
    Route::get('/etudiants/pageModifier/{etudiant}', [EtudiantController::class, 'pageModifier'])->name('etudiant.pageModifier');
    Route::put('/etudiants/modifier/{etudiant}', [EtudiantController::class, 'modifier'])->name('etudiant.modifier');
    Route::delete('/etudiants/supprimer/{etudiant}', [EtudiantController::class, 'supprimer'])->name('etudiant.supprimer');
    
    // Articles 
    Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
    
    // Documents 
    Route::get('/documents', [DocumentController::class, 'index'])->name('document.index');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('document.download');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('document.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('document.store');
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('document.edit');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('document.update');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('document.destroy');
});

// Langues
Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');