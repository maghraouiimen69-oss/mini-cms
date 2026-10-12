<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);

Route::get('/a-propos', [PageController::class, 'about']);

Route::get('/heure', function () {
    return view('heure', [
        'heure' => now()->format('H:i'),
        'date' => now()->format('d/m/Y'),
    ]);
});

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/a-propos', [PageController::class, 'about'])->name('about');

Route::get('/bienvenue', function () {
    return view('bienvenue', [
        'etudiant' => 'Imen Maghraoui',
        'groupe' => 'MDW33',
        'cours' => 'Atelier Framework Côté Serveur',
    ]);
});