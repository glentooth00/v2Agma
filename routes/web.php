<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Registration\MemberRegistration;
use App\Livewire\Members\MembersData;

Route::get('/', function () {
    return view('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');

    Route::get('/members', MembersData::class)
        ->name('members.index');



    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});

Route::get('/agm-registration', MemberRegistration::class)
    ->name('registration.index');