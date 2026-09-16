<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@lojaretrogame.com.br',
            'password' => bcrypt('321456'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@lojaretrogame.com',
            'password' => bcrypt('123654'),
            'role' => 'cliente',
        ]);

        $this->call([
            CategoriaSeeder::class,
            ProdutoSeeder::class,
        ]);
    }
}
