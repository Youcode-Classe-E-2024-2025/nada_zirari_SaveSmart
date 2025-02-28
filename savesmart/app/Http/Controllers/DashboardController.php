<?php


namespace App\Http\Controllers;
use App\Http\Controllers\DashboardController;
use App\Models\Profile;
use App\Models\Transaction;
use App\Models\Category;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    // public function index()
    // {
    //     return view('dashboard');
    // }
//     public function dashboard()
//     {
//         $activeProfileId = session('active_profile_id');

//         if (!$activeProfileId) {
//             return redirect()->route('profiles.index')->with('error', 'Veuillez sélectionner un profil.');
//         }

//         $profile = Profile::findOrFail($activeProfileId);

//         $revenus = $profile->transactions()->where('type', 'revenu')->sum('amount');
//         $depenses = $profile->transactions()->where('type', 'dépense')->sum('amount');

//         return view('dashboard', compact('profile', 'revenus', 'depenses'));
//     }
// }
public function dashboard()
{
    
    $activeProfileId = session('active_profile_id');
    $profile = Profile::findOrFail($activeProfileId);
    $categories = Category::where('profile_id', $activeProfileId)->with('transactions')->get();
    
    $transactions = Transaction::where('profile_id', $activeProfileId)
        ->orderBy('date', 'desc')
        ->take(5)
        ->get();

    $revenus = Transaction::where('profile_id', $activeProfileId)
        ->where('type', 'revenu')
        ->sum('amount');

    $depenses = Transaction::where('profile_id', $activeProfileId)
        ->where('type', 'dépense')
        ->sum('amount');

        return view('dashboard', compact('profile', 'categories', 'transactions', 'revenus', 'depenses'));}}