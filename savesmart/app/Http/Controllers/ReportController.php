<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ReportController extends Controller
{
    public function index()
{
    return view('reports.index');
}


public function exportPDF()
{
    $user = auth()->user();
    $profile = $user->profiles()->first();
    
    $transactions = $profile->transactions;
    
    $pdf = PDF::loadView('reports.pdf', [
        'transactions' => $transactions,
        'profile' => $profile
    ]);

    return $pdf->download('transactions-report.pdf');
}
public function exportExcel()
{
    $user = auth()->user();
    $profile = $user->profiles()->first();
    $transactions = $profile->transactions;

    return Excel::download(new TransactionsExport($transactions), 'transactions.xlsx');
}
}
