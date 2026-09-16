<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSugestaoRequest;
use App\Models\Produto;
use App\Models\Sugestao;
use Illuminate\Support\Facades\Auth;

class SugestaoController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Sugestao::class);

        $user = Auth::user();

        $sugestoes = Sugestao::with('produto', 'user')
            ->when($user->role !== 'admin', fn ($q) => $q->where('user_id', $user->id))
            ->when(request('status'), fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate(10);

        return view('sugestoes.index', compact('sugestoes'));
    }

    
    public function create()
    {
        $this->authorize('create', Sugestao::class);

        $produtos = Produto::orderBy('nome')->get();
        $produtoSelecionado = request('produto_id');

        return view('sugestoes.create', compact('produtos', 'produtoSelecionado'));
    }

   
    public function store(StoreSugestaoRequest $request)
    {
        $this->authorize('create', Sugestao::class);

        $sugestao = Sugestao::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
            'status' => 'pendente',
        ]);

        return redirect()
            ->route('sugestoes.show', $sugestao)
            ->with('success', 'Sugestão enviada com sucesso. Obrigado pelo feedback!');
    }
}