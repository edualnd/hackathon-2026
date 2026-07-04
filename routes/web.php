<?php

use App\Livewire\Mapa;
use Illuminate\Support\Facades\Route;



Route::get("/mapa", Mapa::class)->name("mapa");


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        
        Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
});
