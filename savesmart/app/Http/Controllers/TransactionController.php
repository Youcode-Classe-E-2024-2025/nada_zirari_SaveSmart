<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     $transactions = Transaction::where('user_id', Auth::id())->get();
    //     return view('transactions.index', compact('transactions'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return view('transactions.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required|in:revenu,dépense',
    //         'title' => 'required|string',
    //         'amount' => 'required|numeric',
    //         'date' => 'required|date',
    //     ]);

    //     Transaction::create([
    //         'user_id' => Auth::id(),
    //         'type' => $request->type,
    //         'title' => $request->title,
    //         'amount' => $request->amount,
    //         'date' => $request->date,
    //     ]);

    //     return redirect()->route('transactions.index')->with('success', 'Transaction ajoutée avec succès.');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Transaction $transaction)
    // {
    //     $this->authorize('update', $transaction);
    //     return view('transactions.edit', compact('transaction'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Transaction $transaction)
    // {
    //     $this->authorize('update', $transaction);

    //     $request->validate([
    //         'title' => 'required|string',
    //         'amount' => 'required|numeric',
    //         'date' => 'required|date',
    //     ]);

    //     $transaction->update($request->only('title', 'amount', 'date'));

    //     return redirect()->route('transactions.index')->with('success', 'Transaction mise à jour.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Transaction $transaction)
    // {
    //     $this->authorize('delete', $transaction);
    //     $transaction->delete();

    //     return redirect()->route('transactions.index')->with('success', 'Transaction supprimée.');
    // }
     // Afficher les transactions du profil actif
     public function index()
     {
         $activeProfileId = session('active_profile_id');
 
         if (!$activeProfileId) {
             return redirect()->route('profiles.index')->with('error', 'Veuillez sélectionner un profil.');
         }
 
         $transactions = Transaction::where('profile_id', $activeProfileId)->get();
 
         return view('transactions.index', compact('transactions'));
     }
 
     // Formulaire pour créer une transaction
     public function create()
     {
         return view('transactions.create');
     }
 
     // Enregistrer une nouvelle transaction
     public function store(Request $request)
     {
         $request->validate([
             'description' => 'required|string|max:255',
             'amount' => 'required|numeric',
             'type' => 'required|in:revenu,dépense',
         ]);
 
         $activeProfileId = session('active_profile_id');
 
         if (!$activeProfileId) {
             return redirect()->route('profiles.index')->with('error', 'Veuillez sélectionner un profil.');
         }
 
         Transaction::create([
             'profile_id' => $activeProfileId,
             'description' => $request->description,
             'amount' => $request->amount,
             'type' => $request->type,
         ]);
 
         return redirect()->route('transactions.index')->with('success', 'Transaction ajoutée avec succès.');
     }
 }
}
