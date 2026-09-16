<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sugestão #{{ $sugestao->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6 mb-6 space-y-4">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-gray-500">Produto</dt>
                        <dd class="text-gray-900">{{ $sugestao->produto->nome }}</dd>
                    </div>
                    @if (auth()->user()->role === 'admin')
                        <div>
                            <dt class="text-gray-500">Cliente</dt>
                            <dd class="text-gray-900">{{ $sugestao->user->name }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-gray-500">Nota</dt>
                        <dd class="text-gray-900">{{ $sugestao->nota ? $sugestao->nota.' ★' : 'Não informada' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Status</dt>
                        <dd class="text-gray-900 capitalize">{{ str_replace('_', ' ', $sugestao->status) }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Enviada em</dt>
                        <dd class="text-gray-900">{{ $sugestao->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>

                <div>
                    <dt class="text-gray-500 text-sm">Mensagem</dt>
                    <dd class="text-gray-900 mt-1">{{ $sugestao->mensagem }}</dd>
                </div>

                @if ($sugestao->resposta_admin)
                    <div class="border-t pt-4">
                        <dt class="text-gray-500 text-sm">Resposta da loja</dt>
                        <dd class="text-gray-900 mt-1">{{ $sugestao->resposta_admin }}</dd>
                    </div>
                @endif
            </div>

            @if (auth()->user()->role === 'admin')
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="font-medium text-gray-800 mb-4">Gerenciar sugestão</h3>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sugestoes.update', $sugestao) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label value="Status" />
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach (['pendente' => 'Pendente', 'em_analise' => 'Em análise', 'respondida' => 'Respondida', 'fechada' => 'Fechada'] as $valor => $rotulo)
                                    <option value="{{ $valor }}" @selected(old('status', $sugestao->status) == $valor)>{{ $rotulo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Resposta ao cliente (opcional)" />
                            <textarea name="resposta_admin" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('resposta_admin', $sugestao->resposta_admin) }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            @can('delete', $sugestao)
                <form method="POST" action="{{ route('sugestoes.destroy', $sugestao) }}"
                      onsubmit="return confirm('Tem certeza que deseja excluir esta sugestão?');" class="mt-6">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                        Excluir sugestão
                    </button>
                </form>
            @endcan

            <div class="mt-6">
                <a href="{{ route('sugestoes.index') }}" class="text-gray-700 hover:underline text-sm">
                    &larr; Voltar para {{ auth()->user()->role === 'admin' ? 'as sugestões' : 'minhas sugestões' }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>