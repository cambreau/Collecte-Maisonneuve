<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Afficher la liste des etudiants.
     */
    public function listeEtuidants()
    {
        // SELECT * FROM etudiants;
        $etudiants = Etudiant::with('ville')->get();
        $villes = Ville::all(); 
        return view('etudiant.listeEtudiant', ['etudiants' => $etudiants, 'villes'=> $villes]);
    }

    /**
     * Afficher le formulaire de création d'un nouvel etudiant.
     */
    public function pageCreation()
    {
        $villes = Ville::all(); 
        return view('etudiant.creer', ['villes' => $villes]);
    }

    /**
     * Enregistrer un nouvel etudiant.
     */
    public function creer(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'date_naissance' => 'required|date',
            'ville' => 'required|exists:villes,id',
        ]);

        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville' => $request->ville,
        ]);

        return redirect()->route('etudiant.profil', $etudiant->id)->with('succes','Étudiant créé avec succès');
    }

    /**
     * Afficher le profil etudiant spécifié.
     */
    public function profil(Etudiant $etudiant)
    {
        $villes = Ville::all();
        return view('etudiant.profil', ['etudiant' => $etudiant, 'villes' => $villes]);
    }

    /**
     * Afficher le formulaire de modification de l'etudiant spécifié.
     */
    public function pageModifier(Etudiant $etudiant)
    {
        $villes = Ville::all();
        return view('etudiant.modifier', ['etudiant' => $etudiant, 'villes' => $villes]);
    }

    /**
     * Mettre à jour l'etudiant dans le stockage.
     */
    public function modifier(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'date_naissance' => 'required|date',
            'ville' => 'required|exists:villes,id',
        ]);

        $etudiant->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville' => $request->ville,
        ]);

        return redirect()->route('etudiant.profil', $etudiant->id)->with('succes','Étudiant mis à jour avec succès');
    }

    /**
     * Supprimer l'etudiant du stockage.
     */
    public function supprimer(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiant.listeEtuidants')->with('succes','Étudiant supprimé avec succès');
    }
}