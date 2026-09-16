<x-app-layout>
    <x-slot name="header">
        Catálogo
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
                $cores = [
                    'Consoles'                  => ['border' => 'border-green-500',  'bg' => 'bg-green-900/30',  'badge' => 'bg-green-900 text-green-300'],
                    'Jogos de Tabuleiro'        => ['border' => 'border-purple-500', 'bg' => 'bg-purple-900/30', 'badge' => 'bg-purple-900 text-purple-300'],
                    'Cartuchos e Jogos Físicos' => ['border' => 'border-cyan-500',   'bg' => 'bg-cyan-900/30',   'badge' => 'bg-cyan-900 text-cyan-300'],
                    'Acessórios'                => ['border' => 'border-yellow-500', 'bg' => 'bg-yellow-900/30', 'badge' => 'bg-yellow-900 text-yellow-300'],
                    'Colecionáveis'             => ['border' => 'border-rose-500',   'bg' => 'bg-rose-900/30',   'badge' => 'bg-rose-900 text-rose-300'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($produtos as $produto)
                    @php
                        $cor = $cores[$produto->categoria->nome] ?? ['border' => 'border-orange-500', 'bg' => 'bg-orange-900/30', 'badge' => 'bg-orange-900 text-orange-300'];
                    @endphp

                    <div class="bg-gray-800 border-2 {{ $cor['border'] }} rounded overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="{{ $cor['bg'] }} px-4 py-5 flex items-center min-h-[80px]">
                            <h3 style="font-family: 'Press Start 2P', sans-serif;" class="text-sm text-gray-100 leading-relaxed">
                                {{ $produto->nome }}
                            </h3>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-300 text-base mb-2">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                            <span class="inline-block text-xs {{ $cor['badge'] }} px-3 py-1 rounded-full">
                                {{ $produto->categoria->nome }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $produtos->links() }}
        </div>
    </div>
</x-app-layout>