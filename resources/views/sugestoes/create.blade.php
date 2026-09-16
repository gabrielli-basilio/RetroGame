<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Enviar sugestão
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('sugestoes.store') }}" class="bg-white shadow-sm rounded-lg p-6 space-y-4">
                @csrf

                <div>
                    <x-input-label value="Produto" />
                    <select name="produto_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        <option value="">Selecione...</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}" @selected(old('produto_id', $produtoSelecionado) == $produto->id)>
                                {{ $produto->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label value="Nota (opcional)" />
                    <select name="nota" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Sem nota</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" @selected(old('nota') == $i)>{{ $i }} estrela{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <x-input-label value="Sua sugestão ou avaliação" />
                    <textarea name="mensagem" rows="5"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                              placeholder="Conte o que achou do produto ou deixe uma sugestão..."
                              required>{{ old('mensagem') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                        Enviar sugestão
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>