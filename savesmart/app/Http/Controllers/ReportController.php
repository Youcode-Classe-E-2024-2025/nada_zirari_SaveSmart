<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
{
    return view('reports.index');
}
public function exportExcel()
{
    $transactions = Transaction::where('user_id', auth()->id())->get();
    return Excel::download(new TransactionsExport($transactions), 'rapport_financier.xlsx');
}
}
