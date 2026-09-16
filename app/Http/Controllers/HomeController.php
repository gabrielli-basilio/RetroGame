<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->latest()->paginate(12);
       
        return view('home', compact('produtos'));
    }
}
