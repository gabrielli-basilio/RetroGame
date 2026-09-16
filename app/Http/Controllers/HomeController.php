<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')
            ->when(request('categoria_id'), fn($q, $id) => $q->where('categoria_id', $id))
            ->latest()
            ->paginate(12)
            ->withQueryString();

            $categorias = Categoria::orderBy('nome')->get();
       
        return view('home', compact('produtos', 'categorias'));
    }
}
