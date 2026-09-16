<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar produto
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('produtos.update', $produto) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('produtos._form')

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('produtos.index') }}" class="px-4 py-2 rounded-md border border-gray-300">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
