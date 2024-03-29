<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookInventoryController;

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

Route::get('/', 'HomeController')->name('home');
Route::get('book', 'BookManagementController')->name('book-management');
Route::get('borrower', 'BookBorrowerController')->name('book-borrower');
Route::get('inventory', [BookInventoryController::class, 'index'])->name('book-inventory');
Route::get('inventory/borrowers/{book_id}', [BookInventoryController::class, 'showBorrower'])->name('book-inventory.borrower');
