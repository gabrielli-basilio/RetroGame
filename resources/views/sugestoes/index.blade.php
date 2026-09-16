<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            {{ auth()->user()->role === 'admin' ? 'Sugestões recebidas' : 'Minhas sugestões' }}
            @if (auth()->user()->role !== 'admin')
                <a href="{{ route('sugestoes.create') }}"
                class="text-sm text-green-400 hover:underline">
                    + Nova sugestão
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-900/30 text-green-300 border border-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (auth()->user()->role === 'admin')
                <div class="mb-4 flex gap-2 text-sm">
                    @foreach (['' => 'Todas', 'pendente' => 'Pendentes', 'em_analise' => 'Em análise', 'respondida' => 'Respondidas', 'fechada' => 'Fechadas'] as $valor => $rotulo)
                        <a href="{{ route('sugestoes.index', $valor ? ['status' => $valor] : []) }}"
                           class="px-3 py-1 rounded-full border border-gray-700 {{ request('status') == $valor ? 'bg-green-700 text-white' : 'bg-gray-800 text-gray-300' }}">
                            {{ $rotulo }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="bg-gray-800 border-2 border-gray-700 rounded overflow-hidden">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Produto</th>
                            @if (auth()->user()->role === 'admin')
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Cliente</th>
                            @endif
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Nota</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Data</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($sugestoes as $sugestao)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-200">{{ $sugestao->produto->nome }}</td>
                                @if (auth()->user()->role === 'admin')
                                    <td class="px-4 py-3 text-sm text-gray-200">{{ $sugestao->user->name }}</td>
                                @endif
                                <td class="px-4 py-3 text-sm text-gray-200">{{ $sugestao->nota ? $sugestao->nota.' ★' : '—' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-200 capitalize">{{ str_replace('_', ' ', $sugestao->status) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-400">{{ $sugestao->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('sugestoes.show', $sugestao) }}" class="text-green-400 hover:underline text-sm">
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