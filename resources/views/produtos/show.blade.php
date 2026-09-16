<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $produto->nome }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden md:flex">
                <div class="md:w-1/3">
                    @if ($produto->imagem)
                        <img src="{{ Storage::url($produto->imagem) }}" alt="{{ $produto->nome }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-gray-400">
                            Sem imagem
                        </div>
                    @endif
                </div>

                <div class="p-6 md:w-2/3">
                    <p class="text-sm text-gray-500 mb-1">{{ $produto->categoria->nome }}</p>
                    <h1 class="text-2xl font-semibold text-gray-900 mb-3">{{ $produto->nome }}</h1>
                    <p class="text-gray-600 mb-4">{{ $produto->descricao ?? 'Sem descrição.' }}</p>

                    <p class="text-2xl font-bold text-gray-900 mb-2">
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                    </p>
                    <p class="text-sm {{ $produto->estoque > 0 ? 'text-green-600' : 'text-red-600' }} mb-6">
                        {{ $produto->estoque > 0 ? "{$produto->estoque} unidades em estoque" : 'Fora de estoque' }}
                    </p>

                    <a href="{{ route('produtos.index') }}" class="text-gray-600 hover:underline">
                        &larr; Voltar para o catálogo
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
