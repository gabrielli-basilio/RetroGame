<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSugestaoRequest;
use App\Http\Requests\UpdateSugestaoRequest;
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

    /**
     * Exibe os detalhes de uma sugestão (dono ou admin).
     */
    public function show(Sugestao $sugestao)
    {
        $this->authorize('view', $sugestao);

        $sugestao->load('produto', 'user');

        return view('sugestoes.show', compact('sugestao'));
    }

    /**
     * O admin visualiza e gerencia a sugestão: altera status, responde e fecha.
     */
    public function update(UpdateSugestaoRequest $request, Sugestao $sugestao)
    {
        $this->authorize('update', $sugestao);

        $dados = $request->validated();

        if (in_array($dados['status'], ['respondida', 'fechada'], true) && filled($dados['resposta_admin'] ?? null)) {
            $dados['respondida_em'] = now();
        }

        $sugestao->update($dados);

        return redirect()
            ->route('sugestoes.show', $sugestao)
            ->with('success', 'Sugestão atualizada com sucesso.');
    }

    public function destroy(Sugestao $sugestao)
    {
        $this->authorize('delete', $sugestao);

        $sugestao->delete();

        return redirect()
            ->route('sugestoes.index')
            ->with('success', 'Sugestão removida com sucesso.');
    }
}