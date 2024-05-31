<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/{city}', [\App\Http\Controllers\CompanyController::class, 'getCompaniesByCity'])->name('city-companies');

Route::get('/', function () {
    $companies = \App\Models\Company::all();
    return view('welcome', ['companies'=>$companies]);
})->name('companies');

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
