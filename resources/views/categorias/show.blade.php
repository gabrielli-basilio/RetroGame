<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $categoria->nome }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <p class="text-gray-600">{{ $categoria->descricao ?? 'Sem descrição.' }}</p>
            </div>

            <h3 class="text-lg font-medium text-gray-800 mb-3">Produtos desta categoria</h3>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estoque</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($categoria->produtos as $produto)
                            <tr>
                                <td class="px-4 py-3">
                                    <a href="{{ route('produtos.show', $produto) }}" class="text-gray-900 hover:underline">
                                        {{ $produto->nome }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-gray-600">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $produto->estoque }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                    Nenhum produto nesta categoria ainda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('categorias.index') }}" class="text-gray-600 hover:underline">
                    &larr; Voltar para categorias
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
