<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Catálogo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($produtos as $produto)
                <div>
                    <h3>{{ $produto->nome }}</h3>
                    <p>R$ {{ $produto->preco }}</p>
                    <p>{{ $produto->categoria->nome }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>