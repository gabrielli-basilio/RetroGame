<?php

namespace App\Policies;

use App\Models\Sugestao;
use App\Models\User;

class SugestaoPolicy
{
    /**
     * A listagem em si é filtrada no controller (cliente vê as suas, admin vê todas).
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Sugestao $sugestao): bool
    {
        return $user->role === 'admin' || $user->id === $sugestao->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Gerenciar (responder/alterar status/fechar) é exclusivo do admin.
     */
    public function update(User $user, Sugestao $sugestao): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Sugestao $sugestao): bool
    {
        return $user->role === 'admin' || ($user->id === $sugestao->user_id && $sugestao->status === 'pendente');
    }
}