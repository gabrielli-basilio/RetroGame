<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo pedido
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('pedidos.store') }}" class="bg-white shadow-sm rounded-lg p-6">
                @csrf

                <div class="space-y-4" id="itens-wrapper">
                    <div class="grid grid-cols-12 gap-3 items-end item-linha">
                        <div class="col-span-8">
                            <x-input-label value="Produto" />
                            <select name="itens[0][produto_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Selecione...</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}">
                                        {{ $produto->nome }} — R$ {{ number_format($produto->preco, 2, ',', '.') }} ({{ $produto->estoque }} em estoque)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-3">
                            <x-input-label value="Quantidade" />
                            <input type="number" name="itens[0][quantidade]" min="1" value="1"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-item"
                        class="mt-4 text-sm text-gray-700 hover:underline">
                    + Adicionar outro produto
                </button>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                        Finalizar pedido
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let itemIndex = 1;
        document.getElementById('add-item').addEventListener('click', function () {
            const wrapper = document.getElementById('itens-wrapper');
            const linha = wrapper.querySelector('.item-linha').cloneNode(true);

            linha.querySelectorAll('select, input').forEach(function (campo) {
                campo.name = campo.name.replace(/\[\d+\]/, `[${itemIndex}]`);
                if (campo.tagName === 'SELECT') campo.selectedIndex = 0;
                if (campo.tagName === 'INPUT') campo.value = 1;
            });

            wrapper.appendChild(linha);
            itemIndex++;
        });
    </script>
</x-app-layout>