<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
{
    $currentProfile = session('current_profile');
    
    $transactions = Transaction::where('profile_id', $currentProfile->id)
        ->with('category')
        ->latest()
        ->get();
        
    $savingsGoals = SavingsGoal::where('profile_id', $currentProfile->id)->get();
    
    return view('dashboard', compact('transactions', 'savingsGoals'));
}

}
