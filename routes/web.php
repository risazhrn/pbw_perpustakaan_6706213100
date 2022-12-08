<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/userRegistration', [UserController::class, 'create'])->name('userRegistration');
    Route::post('/userStore', [UserController::class, 'store'])->name('userStore');
    Route::get('/userView/{user}', [UserController::class, 'show'])->name('userView');

    // Koleksi
    Route::get('/koleksi', [CollectionController::class, 'index'])->name('koleksi');
    Route::get('/koleksiTambah', [CollectionController::class, 'create'])->name('koleksiTambah');
    Route::post('/koleksiStore', [CollectionController::class, 'store'])->name('koleksiStore');
    Route::get('/kolesiView/{collection}', [CollectionController::class, 'show'])->name('koleksiView');
    Route::put('/koleksiUpdate/{collection}', [CollectionController::class, 'update'])->name('koleksiUpdate');

    // Transaksi
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi');
    Route::get('/transaksiTambah', [TransactionController::class, 'create'])->name('transaksiTambah');
    Route::post('/transaksiStore', [TransactionController::class, 'store'])->name('transactionStore');
    Route::get('/transaksiView/{transaction}', [TransactionController::class, 'show'])->name('transactionView');

    // Detail Transaction
    Route::get('/detailTransactionKembalikan/{detailTransaction}', [DetailTransactionController::class, 'detailTransactionKembalikan'])->name('detailTransactionKembalikan');
    Route::put('/detailTransactionUpdate', [DetailTransactionController::class, 'update'])->name('detailTransactionUpdate');

    // Get All
    Route::get('/getAllCollections', [CollectionController::class, 'getAllCollections'])->name('getAllCollections');
    Route::get('/getAllUsers', [UserController::class, 'getAllUsers'])->name('getAllUsers');
    Route::get('/getAllTransactions', [TransactionController::class, 'getAllTransactions'])->name('getAllTransactions');
    Route::get('/getAllDetailTransactions/{transaction}', [DetailTransactionController::class, 'getAllDetailTransactions'])->name('getAllDetailTransactions');
});

require __DIR__ . '/auth.php';
