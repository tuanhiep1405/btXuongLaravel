<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/payment', [PaymentController::class, 'showStartTransactionForm'])->name('transaction.start');
Route::post('/payment', [PaymentController::class, 'startTransaction'])->name('transaction.store');
Route::get('/xacthuc', [PaymentController::class, 'showConfirmTransactionForm'])->name('transaction.show');
Route::post('/xacthuc', [PaymentController::class, 'confirmTransaction'])->name('transaction.confirm');

Route::get('/thanhcong', [PaymentController::class, 'showCompletedTransaction'])->name('transaction.completed');
Route::post('/transaction/cancel', [PaymentController::class, 'cancelTransaction'])->name('transaction.cancel');
