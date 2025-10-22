<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SetLocaleController;

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




Route::get('/', [EtudiantController::class, 'listeEtuidants'])->name('etudiant.listeEtuidants');

Route::get('/etudiants', [EtudiantController::class, 'listeEtuidants'])->name('etudiant.listeEtuidants');

// Auth routes
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

// Public 
Route::get('/etudiants/pageCreation', [EtudiantController::class, 'pageCreation'])->name('etudiant.pageCreation');
Route::post('/etudiants/creer', [EtudiantController::class, 'creer'])->name('etudiant.creer');

// Protégées
Route::middleware('auth')->group(function () {
    Route::get('/etudiants/profil/{etudiant}', [EtudiantController::class, 'profil'])->name('etudiant.profil');
    Route::get('/etudiants/pageModifier/{etudiant}', [EtudiantController::class, 'pageModifier'])->name('etudiant.pageModifier');
    Route::put('/etudiants/modifier/{etudiant}', [EtudiantController::class, 'modifier'])->name('etudiant.modifier');
    Route::delete('/etudiants/supprimer/{etudiant}', [EtudiantController::class, 'supprimer'])->name('etudiant.supprimer');
});

// Langues
Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');