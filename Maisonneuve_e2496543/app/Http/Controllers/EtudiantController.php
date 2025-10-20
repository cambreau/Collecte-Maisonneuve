<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EtudiantController extends Controller
{
    /**
     * Protege le profil => Il faut que l'utilisateur soit connecté.
     */    
    public function __construct()
    {
        $this->middleware('auth')->only(['profil']);
    }

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
        // SELECT * FROM villes;
        $villes = Ville::all(); 
        return view('etudiant.creer', ['villes' => $villes]);
    }

    /**
     * Enregistrer un nouvel etudiant.
     */
    public function creer(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|min:2|max:100',
            'adresse' => 'required|string|min:2|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:etudiants,email',
            'password' =>  [ 'required', 'confirmed', 'max:20',  Password::min(8) ->letters() ->mixedCase() ->numbers() ], 
            'date_naissance' => 'required|date',
            'ville' => 'required|exists:villes,id',
        ]);

        // Crée l'utilisateur lié aux identifiants de connexion.
        $utilisateur = User::create([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($utilisateur){
        // Crée l'etudiant.
        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville' => $request->ville,
        ]);}

        if($utilisateur && $etudiant){
            return redirect()->route('login')->with('succes','Compte créé, veuillez vous connecter.');
        }else{
             // SELECT * FROM villes;
            $villes = Ville::all(); 
            return view('etudiant.creer', ['villes' => $villes, 'erreur'=>'Une erreur est survenue lors de la création du compte. Veuillez réessayer plus tard.']);
        }   
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
        // Si l'utilisateur connecte est le meme que celui du profil a modifier
        if (Auth::check() && Auth::user()->email === $etudiant->email) {
            $request->validate([
                'nom' => 'required|string|min:2|max:100',
                'adresse' => 'required|string|min:2|max:255',
                'telephone' => 'required|string|max:20',
                'date_naissance' => 'required|date',
                'ville' => 'required|exists:villes,id',
            ]);

            $etudiant->update([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'date_naissance' => $request->date_naissance,
                'ville' => $request->ville,
            ]);

            return redirect()->route('etudiant.profil', $etudiant->id)->with('succes','Étudiant mis à jour avec succès');
        }
    }

    /**
     * Supprimer l'etudiant du stockage.
     */
    public function supprimer(Request $request,Etudiant $etudiant)
    {
        // Si l'utilisateur connecte est le meme que celui du profil a supprimer
        if (Auth::check() && Auth::user()->email === $etudiant->email) {
            User::where('email', $etudiant->email)->delete();
            $etudiant->delete();
    
            // Déconnexion 
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Session::flush();

        return redirect()->route('login')->with('succes','Étudiant supprimé avec succès');
    }
}
}