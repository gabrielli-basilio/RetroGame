<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ auth()->user()->role === 'admin' ? 'Todos os pedidos' : 'Meus pedidos' }}
            </h2>
            @if (auth()->user()->role !== 'admin')
                <a href="{{ route('pedidos.create') }}"
                   class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                    Novo pedido
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            @if (auth()->user()->role === 'admin')
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                            @endif
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Itens</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($pedidos as $pedido)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $pedido->id }}</td>
                                @if (auth()->user()->role === 'admin')
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $pedido->user->name }}</td>
                                @endif
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $pedido->itens_count }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 capitalize">{{ $pedido->status }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('pedidos.show', $pedido) }}" class="text-gray-900 hover:underline text-sm">
                                        Ver detalhes
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                    Nenhum pedido encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $pedidos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>