<?php


use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;

Route::get('/', [
    HomeController::class, 'index'
])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sugestoes', [SugestaoController::class, 'index'])->name('sugestoes.index');
    Route::get('/sugestoes/nova', [SugestaoController::class, 'create'])->name('sugestoes.create');
    Route::post('/sugestoes', [SugestaoController::class, 'store'])->name('sugestoes.store');
    Route::get('/sugestoes/{sugestao}', [SugestaoController::class, 'show'])->name('sugestoes.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // rotas administrativas já existentes...

    Route::get('/produtos/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');

    Route::put('/sugestoes/{sugestao}', [SugestaoController::class, 'update'])->name('sugestoes.update');
});
    // rotas administrativas

    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

    Route::resource('usuarios', UsuarioController::class)
    ->except(['create', 'store', 'show']);

    Route::resource('categorias', CategoriaController::class)->except(['show']);
    Route::resource('produtos', ProdutoController::class)->except(['index', 'show']);

    Route::get('/produtos/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');


require __DIR__.'/auth.php';
