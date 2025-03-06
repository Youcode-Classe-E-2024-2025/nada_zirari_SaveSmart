<?php
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingsGoalController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/auth.php';


Route::get('/',[HomeController::class,'index']);

Route::get('/dashboard',[DashboardController::class,'index'])->name('user.dashboard');
// routes of graphs
Route::get('/dashboard/charts', [ChartController::class, 'index'])->name('dashboard.charts');
Route::get('/dashboard/savings-goals', [SavingsGoalController::class, 'index'])->name('dashboard.savings-goals');

Route::middleware(['auth'])->group(function () {
    Route::resource('profiles',ProfileController::class)->only(['index','create','store','show']);
    Route::resource('transactions',TransactionController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('goals',SavingsGoalController::class);
    Route::post('/savings-goals', [SavingsGoalController::class, 'store'])->name('savings-goals.store');

});