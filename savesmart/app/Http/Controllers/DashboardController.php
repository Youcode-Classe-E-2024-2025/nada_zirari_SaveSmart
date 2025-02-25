<?php


namespace App\Http\Controllers;
use App\Http\Controllers\DashboardController;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
