<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            Produtos
            <a href="{{ route('produtos.create') }}"
               class="text-sm text-green-400 hover:underline">
                + Novo produto
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-900/30 text-green-300 border border-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" class="mb-4 flex gap-3 items-center">
                <label for="categoria_id" class="text-sm text-gray-300">Filtrar por categoria:</label>
                <select name="categoria_id" id="categoria_id" onchange="this.form.submit()"
                        class="rounded-md bg-gray-800 border-gray-700 text-gray-200">
                    <option value="">Todas</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($produtos as $produto)
                    <div class="bg-gray-800 border-2 border-gray-700 rounded overflow-hidden flex flex-col">
                        @if ($produto->imagem)
                            <img src="{{ Storage::url($produto->imagem) }}" alt="{{ $produto->nome }}"
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-900 flex items-center justify-center text-gray-500">
                                Sem imagem
                            </div>
                        @endif

                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="font-medium text-white">{{ $produto->nome }}</h3>
                            <p class="text-sm text-gray-400 mb-2">{{ $produto->categoria->nome }}</p>
                            <p class="text-gray-200 font-semibold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                            <p class="text-sm text-gray-400 mb-4">
                                {{ $produto->estoque > 0 ? "{$produto->estoque} em estoque" : 'Fora de estoque' }}
                            </p>

                            <div class="mt-auto flex justify-between items-center">
                                <a href="{{ route('produtos.show', $produto) }}" class="text-gray-300 hover:underline text-sm">
                                    Ver detalhes
                                </a>
                                <div class="space-x-2">
                                    <a href="{{ route('produtos.edit', $produto) }}" class="text-green-400 hover:underline text-sm">
                                        Editar
                                    </a>
                                    <form action="{{ route('produtos.destroy', $produto) }}" method="POST"
                                          class="inline" onsubmit="return confirm('Excluir este produto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:underline text-sm">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full text-center py-8">Nenhum produto encontrado.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $produtos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
