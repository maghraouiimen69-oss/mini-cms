<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
               return view('home');
    }

    public function about()
    {
        return view('a-propos', [
            'auteur' => 'Imen Maghraoui',
            'groupe' => 'MDW33',
        ]);
    }
}