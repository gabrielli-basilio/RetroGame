<x-app-layout>
    <x-slot name="header">
        Usuários
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 border-2 border-gray-700 rounded p-6">
                <table class="w-full text-left border-collapse text-gray-200">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="py-2 text-gray-400">Nome</th>
                            <th class="py-2 text-gray-400">Email</th>
                            <th class="py-2 text-gray-400">Role</th>
                            <th class="py-2 text-gray-400">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr class="border-b border-gray-700">
                                <td class="py-2">{{ $usuario->name }}</td>
                                <td class="py-2">{{ $usuario->email }}</td>
                                <td class="py-2">{{ $usuario->role }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="text-green-400 hover:underline">Editar</a>

                                    <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Excluir este usuário?')" class="text-red-400 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>