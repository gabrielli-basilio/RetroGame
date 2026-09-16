<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;

Route::get('/', [
    HomeController::class, 'index'
])->name('home');

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin'])->group(function () {
    // rotas administrativas

    Route::resource('usuarios', UsuarioController::class)
    ->except(['create', 'store', 'show']);

    Route::resource('categorias', CategoriaController::class)->except(['show']);
    Route::resource('produtos', ProdutoController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';
