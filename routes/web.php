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

Route::get('/confirm-reservation/{id}', [\App\Http\Controllers\StripeController::class, 'showReservationForm'])->name('confirm.reservation');
Route::post('/stripe-checkout', [\App\Http\Controllers\StripeController::class, 'stripeCheckout'])->name('stripe.checkout');
Route::get('/stripe-checkout-success', [\App\Http\Controllers\StripeController::class, 'stripeCheckoutSuccess'])->name('stripe.checkout.success');
//Route::get('/pay', [\App\Http\Controllers\ReservationController::class, 'pay'])->name('pay-view');
Route::get('/reserve', [\App\Http\Controllers\ReservationController::class, 'index'])->name('confirm-reservation');
Route::get('/{city}', [\App\Http\Controllers\CompanyController::class, 'getCompaniesByCity'])->name('city-companies');
Route::get('/', [\App\Http\Controllers\CompanyController::class, 'getCities'])->name('welcome');
Route::get('/{city}/{name}', [\App\Http\Controllers\CompanyController::class, 'getCompany'])->name('company');




