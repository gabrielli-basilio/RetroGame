<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sugestao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produto_id',
        'mensagem',
        'nota',
        'status',
        'resposta_admin',
        'respondida_em',
    ];

    protected function casts(): array
    {
        return [
            'nota' => 'integer',
            'respondida_em' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    public function estaFechada(): bool
    {
        return $this->status === 'fechada';
    }
}