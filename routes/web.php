<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Registration\MemberRegistration;

Route::get('/', function () {
    return view('login');
});

Route::get('/agm-registration', MemberRegistration::class)
    ->name('registration.index');