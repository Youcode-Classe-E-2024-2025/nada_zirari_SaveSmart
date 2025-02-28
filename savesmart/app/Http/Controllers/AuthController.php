<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;

class AuthController extends Controller
{

    
    public function showRegisterForm() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Create default profile for the new user
        Profile::create([
            'user_id' => $user->id,
            'name' => $user->name . "'s Profile",
            'is_default' => true
        ]);
    
        return redirect()->route('login')->with('success', 'Inscription réussie. Connectez-vous maintenant.');
    }
    public function showLoginForm() {
     
        $profiles = Profile::all();
        return view('login', compact('profiles'));
    }
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants invalides'])->onlyInput('email');
    }

    // public function logout() {
    //     Auth::logout();
    //     return redirect()->route('login');
    // }
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')->with('success', 'Déconnexion réussie.');
}

}
