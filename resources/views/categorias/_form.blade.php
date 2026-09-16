@php
    $categoria = $categoria ?? null;
@endphp

<div class="mb-4">
    <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
    <input type="text" name="nome" id="nome"
           value="{{ old('nome', $categoria->nome ?? '') }}"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    @error('nome')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
    <textarea name="descricao" id="descricao" rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('descricao', $categoria->descricao ?? '') }}</textarea>
    @error('descricao')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
