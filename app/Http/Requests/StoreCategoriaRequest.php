<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'itens' => ['required', 'array', 'min:1'],
            'itens.*.produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'itens.*.quantidade' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'itens.required' => 'Adicione ao menos um produto ao pedido.',
            'itens.*.produto_id.exists' => 'Produto selecionado é inválido.',
            'itens.*.quantidade.min' => 'A quantidade deve ser de ao menos 1 unidade.',
        ];
    }
}