<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bonjour', function () {
    return 'Bonjour MDW3 ! Voici ma première route Laravel 13.';
});

Route::get('/bonjour-court', fn () => 'Même résultat, écrit avec une fonction fléchée.');

Route::get('/bienvenue', function () {
    return view('bienvenue', [
        'etudiant' => 'Imen Maghraoui',
        'groupe' => 'MDW32',
        'cours' => 'Atelier Framework Côté Serveur',
    ]);
});

Route::get('/version', fn () => 'Laravel ' . app()->version() . ' - PHP ' . PHP_VERSION);

Route::get('/heure', function () {
    return view('heure', ['maintenant' => now()]);
});