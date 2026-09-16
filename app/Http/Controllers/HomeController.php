<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = collect([
            (object) ['nome' => 'Super Nintendo', 'preco' => 350, 'categoria' => (object)['nome' => 'Console']],
            (object) ['nome' => 'Catan', 'preco' => 180, 'categoria' => (object)['nome' => 'Jogo de tabuleiro']],
        ]);

        return view('home', compact('produtos'));
    }
}
