@php
    $produto = $produto ?? null;
@endphp

<div class="mb-4">
    <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
    <input type="text" name="nome" id="nome"
           value="{{ old('nome', $produto->nome ?? '') }}"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    @error('nome')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
    <textarea name="descricao" id="descricao" rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('descricao', $produto->descricao ?? '') }}</textarea>
    @error('descricao')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label for="preco" class="block text-sm font-medium text-gray-700">Preço (R$)</label>
        <input type="number" step="0.01" min="0" name="preco" id="preco"
               value="{{ old('preco', $produto->preco ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('preco')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="estoque" class="block text-sm font-medium text-gray-700">Estoque</label>
        <input type="number" min="0" name="estoque" id="estoque"
               value="{{ old('estoque', $produto->estoque ?? 0) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('estoque')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mb-4">
    <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoria</label>
    <select name="categoria_id" id="categoria_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        <option value="">Selecione...</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}"
                @selected(old('categoria_id', $produto->categoria_id ?? '') == $categoria->id)>
                {{ $categoria->nome }}
            </option>
        @endforeach
    </select>
    @error('categoria_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="imagem" class="block text-sm font-medium text-gray-700">Imagem</label>

    @if (isset($produto) && $produto->imagem)
        <img src="{{ Storage::url($produto->imagem) }}" alt="{{ $produto->nome }}"
             class="w-24 h-24 object-cover rounded-md mb-2">
    @endif

    <input type="file" name="imagem" id="imagem" accept="image/*"
           class="mt-1 block w-full text-sm text-gray-600">
    <p class="text-xs text-gray-400 mt-1">JPG, PNG ou WEBP. Máximo 2MB.</p>
    @error('imagem')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
