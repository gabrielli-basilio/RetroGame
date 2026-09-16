<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pedido #{{ $pedido->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    @if (auth()->user()->role === 'admin')
                        <div>
                            <dt class="text-gray-500">Cliente</dt>
                            <dd class="text-gray-900">{{ $pedido->user->name }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-gray-500">Status</dt>
                        <dd class="text-gray-900 capitalize">{{ $pedido->status }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Data</dt>
                        <dd class="text-gray-900">{{ $pedido->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Total</dt>
                        <dd class="text-gray-900 font-semibold">R$ {{ number_format($pedido->total, 2, ',', '.') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qtd.</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço unit.</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($pedido->itens as $item)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $item->produto->nome }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $item->quantidade }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">R$ {{ number_format($item->subtotal(), 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="{{ route('pedidos.index') }}" class="text-gray-700 hover:underline text-sm">
                    &larr; Voltar para {{ auth()->user()->role === 'admin' ? 'todos os pedidos' : 'meus pedidos' }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>