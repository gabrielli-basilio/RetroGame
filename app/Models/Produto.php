<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'preco', 'estoque', 'imagem', 'categoria_id'];

    protected function casts(): array
    {
        return [
            'preco' => 'decimal:2',
            'estoque' => 'integer',
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
