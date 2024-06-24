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

Route::post('/paypal-checkout', [\App\Http\Controllers\PayPalController::class, 'payWithPayPal'])->name('paypal.checkout');
Route::get('/paypal-success', [\App\Http\Controllers\PayPalController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/paypal-cancel', [\App\Http\Controllers\PayPalController::class, 'paypalCancel'])->name('paypal.cancel');

Route::get('/company/create', [\App\Http\Controllers\CompanyController::class, 'create'])->name('company.create');
Route::post('/company/store', [\App\Http\Controllers\CompanyController::class, 'store'])->name('company.store');

Route::put('/services/{id}', [\App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');
Route::post('/services/store', [\App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{id}/edit', [\App\Http\Controllers\ServiceController::class, 'edit'])->name('services.edit');

Route::get('/user/reservations', [\App\Http\Controllers\ReservationController::class, 'myReservations'])->name('user.reservations');

Route::get('/reserve', [\App\Http\Controllers\ReservationController::class, 'index'])->name('confirm-reservation');
Route::get('/{city}', [\App\Http\Controllers\CompanyController::class, 'getCompaniesByCity'])->name('city-companies');
Route::get('/', [\App\Http\Controllers\CompanyController::class, 'getCities'])->name('welcome');
Route::get('/{city}/{name}', [\App\Http\Controllers\CompanyController::class, 'getCompany'])->name('company');





