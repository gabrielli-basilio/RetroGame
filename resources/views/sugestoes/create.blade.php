<x-app-layout>
    <x-slot name="header">
        Enviar sugestão
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-900/30 text-red-300 border border-red-700 rounded-md">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('sugestoes.store') }}" class="bg-gray-800 border-2 border-gray-700 rounded p-6 space-y-4">
                @csrf

                <div>
                    <x-input-label value="Produto" class="text-gray-300" />
                    <select name="produto_id" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700 text-gray-200" required>
                        <option value="">Selecione...</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}" @selected(old('produto_id', $produtoSelecionado) == $produto->id)>
                                {{ $produto->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label value="Nota (opcional)" class="text-gray-300" />
                    <select name="nota" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700 text-gray-200">
                        <option value="">Sem nota</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" @selected(old('nota') == $i)>{{ $i }} estrela{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <x-input-label value="Sua sugestão ou avaliação" class="text-gray-300" />
                    <textarea name="mensagem" rows="5"
                              class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700 text-gray-200 placeholder-gray-500"
                              placeholder="Conte o que achou do produto ou deixe uma sugestão..."
                              required>{{ old('mensagem') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-600 text-sm">
                        Enviar sugestão
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>