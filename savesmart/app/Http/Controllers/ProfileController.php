<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Liste des profils de l'utilisateur
    public function index()
    {
        $profiles = Profile::where('user_id', Auth::id())->get();
        return view('profiles.index', compact('profiles'));
    }

    // Sélectionner un profil actif
    public function select($id)
    {
        $profile = Profile::where('user_id', Auth::id())->findOrFail($id);
        session(['active_profile_id' => $profile->id]);

        return redirect()->route('dashboard')->with('success', "Profil '{$profile->name}' sélectionné !");
    }

    // Créer un nouveau profil (Formulaire)
    public function create()
    {
        return view('profiles.create');
    }

    // Enregistrer un nouveau profil
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Profile::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return redirect()->route('profiles.index')->with('success', 'Profil créé avec succès.');
    }
}