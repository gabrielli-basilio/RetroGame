<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::with('categoria')
            ->when(request('categoria_id'), fn($q, $id) => $q->where('categoria_id', $id))
            ->orderBy('nome')->paginate(12);
        $categorias = Categoria::orderBy('nome')->get();
        return view('produtos.index', compact('produtos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Produto::class);
        $categorias = Categoria::orderBy('nome')->get();
        return view('produtos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutoRequest $request)
    {
        $this->authorize('create', Produto::class);
        $dados = $request->validated();
        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }
        Produto::create($dados);
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        $produto->load('categoria');
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $this->authorize('update', $produto);
        $categorias = Categoria::orderBy('nome')->get();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $this->authorize('update', $produto);
        $dados = $request->validated();
        if ($request->hasFile('imagem')) {
            if ($produto->imagem) Storage::disk('public')->delete($produto->imagem);
            $dados['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }
        $produto->update($dados);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $this->authorize('delete', $produto);
        if ($produto->imagem) Storage::disk('public')->delete($produto->imagem);
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
    }
}
