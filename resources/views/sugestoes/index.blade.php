<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ auth()->user()->role === 'admin' ? 'Sugestões recebidas' : 'Minhas sugestões' }}
            </h2>
            @if (auth()->user()->role !== 'admin')
                <a href="{{ route('sugestoes.create') }}"
                   class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                    Nova sugestão
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

            @if (auth()->user()->role === 'admin')
                <div class="mb-4 flex gap-2 text-sm">
                    @foreach (['' => 'Todas', 'pendente' => 'Pendentes', 'em_analise' => 'Em análise', 'respondida' => 'Respondidas', 'fechada' => 'Fechadas'] as $valor => $rotulo)
                        <a href="{{ route('sugestoes.index', $valor ? ['status' => $valor] : []) }}"
                           class="px-3 py-1 rounded-full border {{ request('status') == $valor ? 'bg-gray-800 text-white' : 'bg-white text-gray-700' }}">
                            {{ $rotulo }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                            @if (auth()->user()->role === 'admin')
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                            @endif
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nota</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($sugestoes as $sugestao)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $sugestao->produto->nome }}</td>
                                @if (auth()->user()->role === 'admin')
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $sugestao->user->name }}</td>
                                @endif
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $sugestao->nota ? $sugestao->nota.' ★' : '—' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 capitalize">{{ str_replace('_', ' ', $sugestao->status) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $sugestao->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('sugestoes.show', $sugestao) }}" class="text-gray-900 hover:underline text-sm">
                                        Ver detalhes
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                    Nenhuma sugestão encontrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $sugestoes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>