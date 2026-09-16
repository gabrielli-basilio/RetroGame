<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Produtos
            </h2>
            <a href="{{ route('produtos.create') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                Novo produto
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" class="mb-4 flex gap-3 items-center">
                <label for="categoria_id" class="text-sm text-gray-700">Filtrar por categoria:</label>
                <select name="categoria_id" id="categoria_id" onchange="this.form.submit()"
                        class="rounded-md border-gray-300 shadow-sm">
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
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden flex flex-col">
                        @if ($produto->imagem)
                            <img src="{{ Storage::url($produto->imagem) }}" alt="{{ $produto->nome }}"
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">
                                Sem imagem
                            </div>
                        @endif

                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="font-medium text-gray-900">{{ $produto->nome }}</h3>
                            <p class="text-sm text-gray-500 mb-2">{{ $produto->categoria->nome }}</p>
                            <p class="text-gray-800 font-semibold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                            <p class="text-sm text-gray-500 mb-4">
                                {{ $produto->estoque > 0 ? "{$produto->estoque} em estoque" : 'Fora de estoque' }}
                            </p>

                            <div class="mt-auto flex justify-between items-center">
                                <a href="{{ route('produtos.show', $produto) }}" class="text-gray-900 hover:underline">
                                    Ver detalhes
                                </a>
                                <div class="space-x-2">
                                    <a href="{{ route('produtos.edit', $produto) }}" class="text-blue-600 hover:underline text-sm">
                                        Editar
                                    </a>
                                    <form action="{{ route('produtos.destroy', $produto) }}" method="POST"
                                          class="inline" onsubmit="return confirm('Excluir este produto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Excluir</button>
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
