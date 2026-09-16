<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consoles = Categoria::where('nome', 'Consoles')->first();
        $cartuchos = Categoria::where('nome', 'Cartuchos e Jogos Físicos')->first();
        $tabuleiro = Categoria::where('nome', 'Jogos de Tabuleiro')->first();
        $acessorios = Categoria::where('nome', 'Acessórios')->first();

        $produtos = [
            ['nome' => 'Super Nintendo (SNES)', 'descricao' => 'Console clássico da Nintendo.', 'preco' => 899.90, 'estoque' => 5, 'categoria_id' => $consoles?->id],
            ['nome' => 'Mega Drive', 'descricao' => 'Console clássico da Sega.', 'preco' => 749.00, 'estoque' => 3, 'categoria_id' => $consoles?->id],
            ['nome' => 'Chrono Trigger (SNES)', 'descricao' => 'Cartucho original de RPG clássico.', 'preco' => 450.00, 'estoque' => 2, 'categoria_id' => $cartuchos?->id],
            ['nome' => 'Sonic the Hedgehog (Mega Drive)', 'descricao' => 'Cartucho original de plataforma.', 'preco' => 180.00, 'estoque' => 8, 'categoria_id' => $cartuchos?->id],
            ['nome' => 'Catan', 'descricao' => 'Jogo de tabuleiro de estratégia e negociação.', 'preco' => 220.00, 'estoque' => 10, 'categoria_id' => $tabuleiro?->id],
            ['nome' => 'War - Jogo de Estratégia', 'descricao' => 'Clássico jogo de conquista territorial.', 'preco' => 150.00, 'estoque' => 6, 'categoria_id' => $tabuleiro?->id],
            ['nome' => 'Controle SNES Original', 'descricao' => 'Controle original para Super Nintendo.', 'preco' => 120.00, 'estoque' => 15, 'categoria_id' => $acessorios?->id],
        ];

        foreach ($produtos as $produto) {
            Produto::firstOrCreate(['nome' => $produto['nome']], $produto);
        }
    }
}
