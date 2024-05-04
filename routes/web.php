<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

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

    Route::resource('tenants', TenantController::class)->except(['show']);
});

require __DIR__.'/auth.php';

Route::get('/test', function() {
    // Get tenant child
    $tenant = \App\Models\Tenant::first();
    tenancy()->initialize($tenant);

    $user = \App\Models\User::first();

    // Get tenant parent from child
    $userCentral = tenancy()->central(function () {
        return \App\Models\User::first();
    });

    // Return to parent child
    tenancy()->end(); //TODO: fix [tenant] configurtion

    return $user;
});
