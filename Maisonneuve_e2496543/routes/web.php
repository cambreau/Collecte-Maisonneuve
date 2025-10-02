<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\EtudiantController;


Route::get('/', [EtudiantController::class, 'listeEtuidants'])->name('etudiant.listeEtuidants');

Route::get('/etudiants', [EtudiantController::class, 'listeEtuidants'])->name('etudiant.listeEtuidants');

Route::get('/etudiants/creer', [EtudiantController::class, 'pageCreation'])->name('etudiant.creer');
Route::post('/etudiants', [EtudiantController::class, 'Creer'])->name('etudiant.store');

Route::get('/etudiants/{etudiant}', [EtudiantController::class, 'profil'])->name('etudiant.profil');

Route::get('/etudiants/{etudiant}/modifier', [EtudiantController::class, 'pageModifier'])->name('etudiant.edit');
Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'modifier'])->name('etudiant.update');

Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'supprimer'])->name('etudiant.supprimer');
