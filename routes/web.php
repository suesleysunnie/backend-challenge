<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Import
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes');
    //Route::get('/cliente/{id}', [ClienteController::class, 'show'])->name('cliente');

    Route::get('pedidos', [PedidoController::class, 'index'])->name('pedidos');
    Route::get('pedidos/abertos', [PedidoController::class, 'abertos']);
    Route::get('pedido/{id}/editar', [PedidoController::class, 'edit']);
    Route::get('pedido/{id}', [PedidoController::class, 'show']);
    Route::put('pedido/{id}', [PedidoController::class, 'update']);

    /*Route::get('produtos', [ProdutoController::class, 'index'])->name('produtos');
    Route::resource('produto', ProdutoController::class);*/

    Route::get('produtos', [ProdutoController::class, 'index'])->name('produtos');
    Route::get('produto/novo', [ProdutoController::class, 'create']);
    Route::get('produto/{id}/editar', [ProdutoController::class, 'edit']);
    Route::post('produto', [ProdutoController::class, 'store']);
    Route::put('produto/{id}', [ProdutoController::class, 'update']);
    Route::delete('produto/{id}', [ProdutoController::class, 'destroy']);
});
