<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Etudiant;

class AuthController extends Controller
{
    /**
     * Dirige vers la page de connexion.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Creer une nouvel User 
     */
    public function store(Request $request)
    {
        $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required|min:8|max:20'
        ]);

        $credentials = $request->only('email', 'password');
        if(!Auth::validate($credentials)):
            return redirect(route('login'))->withErrors(trans('auth.failed'))->withInput();
        endif;
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);

        // Rediriger vers le profil de l'étudiant si trouvé, sinon vers la liste
        $etudiant = Etudiant::where('email', $request->email)->first();
        if ($etudiant) {
            return redirect()->route('etudiant.profil', $etudiant->id)->with('succes', 'Connexion réussie.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect(route('auth.login'));
    }
} 


