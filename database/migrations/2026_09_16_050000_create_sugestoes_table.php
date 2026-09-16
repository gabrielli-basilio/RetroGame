<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sugestoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('mensagem');
            $table->unsignedTinyInteger('nota')->nullable();
            $table->string('status')->default('pendente');
            $table->text('resposta_admin')->nullable();
            $table->timestamp('respondida_em')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sugestoes');
    }
};