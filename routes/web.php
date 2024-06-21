<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/', [\App\Http\Controllers\CompanyController::class, 'create']
)->name('company.create');

Route::delete('/{id}', [\App\Http\Controllers\CompanyController::class, 'delete']
)->name('company.delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/pay', 'App\Http\Controllers\StripeController@index')->name('pay-view');
Route::post('/checkout', 'App\Http\Controllers\StripeController@checkout');
Route::get('/success', 'App\Http\Controllers\StripeController@success');
//Route::get('/pay', [\App\Http\Controllers\ReservationController::class, 'pay'])->name('pay-view');
Route::get('/reserve', [\App\Http\Controllers\ReservationController::class, 'index'])->name('reserve');
Route::get('/{city}', [\App\Http\Controllers\CompanyController::class, 'getCompaniesByCity'])->name('city-companies');
Route::get('/', [\App\Http\Controllers\CompanyController::class, 'getCities'])->name('welcome');
Route::get('/{city}/{name}', [\App\Http\Controllers\CompanyController::class, 'getCompany'])->name('company');




