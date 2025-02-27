<?php


namespace App\Http\Controllers;
use App\Http\Controllers\DashboardController;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     return view('dashboard');
    // }
    public function dashboard()
    {
        $activeProfileId = session('active_profile_id');

        if (!$activeProfileId) {
            return redirect()->route('profiles.index')->with('error', 'Veuillez sélectionner un profil.');
        }

        $profile = Profile::findOrFail($activeProfileId);

        $revenus = $profile->transactions()->where('type', 'revenu')->sum('amount');
        $depenses = $profile->transactions()->where('type', 'dépense')->sum('amount');

        return view('dashboard', compact('profile', 'revenus', 'depenses'));
    }
}
