<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Consoles', 'descricao' => 'Consoles retrô e de linha clássica.'],
            ['nome' => 'Cartuchos e Jogos Físicos', 'descricao' => 'Jogos originais em cartucho ou CD.'],
            ['nome' => 'Jogos de Tabuleiro', 'descricao' => 'Jogos de tabuleiro clássicos e modernos.'],
            ['nome' => 'Acessórios', 'descricao' => 'Controles, cabos, memory cards e periféricos.'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(['nome' => $categoria['nome']], $categoria);
        }
    }
}
