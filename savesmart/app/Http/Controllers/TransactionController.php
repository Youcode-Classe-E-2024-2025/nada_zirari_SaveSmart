<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = auth()->user()->profiles()->where('id', session('current_profile_id'))->first();
        return view('dashboard.transactions', compact('profile'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
           'transaction_date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:expense,income'], 
            'amount' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);
        
        $validated['profile_id']=  session('current_profile_id');
        // dd($validated);
        Transaction::create($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaction ajouté avec succès !');
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'transaction_date' => 'required|date'
        ]);
    
        $transaction->update($validated);
        return redirect()->back()->with('success', 'Transaction modifiée avec succès');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
{
    $transaction->delete();
    return redirect()->back()->with('success', 'Transaction supprimée avec succès');
}

}
