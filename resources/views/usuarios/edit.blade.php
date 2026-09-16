<x-app-layout>
    <x-slot name="header">
        Editar usuário
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 border-2 border-gray-700 rounded p-6">
                <p class="mb-4 text-gray-300">{{ $usuario->name }} — {{ $usuario->email }}</p>

                <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
                    @csrf
                    @method('PUT')

                    <label for="role" class="block text-sm font-medium text-gray-300">Role</label>
                    <select name="role" id="role" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700 text-gray-200">
                        <option value="cliente" @selected($usuario->role === 'cliente')>Cliente</option>
                        <option value="admin" @selected($usuario->role === 'admin')>Admin</option>
                    </select>

                    <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>