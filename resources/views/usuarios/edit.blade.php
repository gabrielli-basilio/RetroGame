<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar usuário
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p>{{ $usuario->name }} — {{ $usuario->email }}</p>

            <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
                @csrf
                @method('PUT')

                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="cliente" @selected($usuario->role === 'cliente')>Cliente</option>
                    <option value="admin" @selected($usuario->role === 'admin')>Admin</option>
                </select>

                <button type="submit">Salvar</button>
            </form>
        </div>
    </div>
</x-app-layout>