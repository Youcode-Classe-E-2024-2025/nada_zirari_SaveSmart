<?php

namespace App\Http\Controllers;

use App\Models\SavingsGoal;
use Illuminate\Http\Request;

class SavingsGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savingsGoals = SavingsGoal::where('user_id', auth()->id())->get();
        return view('dashboard.savings-goals', compact('savingsGoals'));
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
        'title' => 'required|string|max:255',
        'target_amount' => 'required|numeric|min:0',
        'current_amount' => 'required|numeric|min:0',
    ]);

    $validated['user_id'] = auth()->id();
    SavingsGoal::create($validated);

    return redirect()->back()->with('success', 'Objectif d\'épargne créé avec succès!');
}

    /**
     * Display the specified resource.
     */
    public function show(SavingsGoal $savingsGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavingsGoal $savingsGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SavingsGoal $savingsGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SavingsGoal $savingsGoal)
    {
        //
    }
}
