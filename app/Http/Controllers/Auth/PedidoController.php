<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Pedido::class);

        $user = Auth::user();

        $pedidos = Pedido::with('user')
            ->withCount('itens')
            ->when($user->role !== 'admin', fn ($q) => $q->where('user_id', $user->id))
            ->latest()
            ->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $this->authorize('create', Pedido::class);

        $produtos = Produto::where('estoque', '>', 0)->orderBy('nome')->get();

        return view('pedidos.create', compact('produtos'));
    }

    public function store(StorePedidoRequest $request)
    {
        $this->authorize('create', Pedido::class);

        $dados = $request->validated();

        $pedido = DB::transaction(function () use ($dados) {
            $pedido = Pedido::create([
                'user_id' => Auth::id(),
                'status' => 'pendente',
                'total' => 0,
            ]);

            $total = 0;

            foreach ($dados['itens'] as $item) {
                $produto = Produto::findOrFail($item['produto_id']);

                if ($produto->estoque < $item['quantidade']) {
                    abort(422, "Estoque insuficiente para o produto {$produto->nome}.");
                }

                $pedido->itens()->create([
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $produto->preco,
                ]);

                $produto->decrement('estoque', $item['quantidade']);
                $total += $item['quantidade'] * $produto->preco;
            }

            $pedido->update(['total' => $total]);

            return $pedido;
        });

        return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido realizado com sucesso.');
    }

    public function show(Pedido $pedido)
    {
        $this->authorize('view', $pedido);

        $pedido->load('itens.produto', 'user');

        return view('pedidos.show', compact('pedido'));
    }
}