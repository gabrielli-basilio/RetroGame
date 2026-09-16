<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSugestaoRequest extends FormRequest
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
            'produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'mensagem' => ['required', 'string', 'min:5', 'max:2000'],
            'nota' => ['nullable', 'integer', 'between:1,5'],
        ];
    }

    public function messages(): array
    {
        return [
            'produto_id.exists' => 'Produto selecionado é inválido.',
            'mensagem.required' => 'Escreva sua sugestão ou avaliação.',
            'mensagem.min' => 'A mensagem precisa ter pelo menos 5 caracteres.',
            'nota.between' => 'A nota deve ser de 1 a 5.',
        ];
    }
}