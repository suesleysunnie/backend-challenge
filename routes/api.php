<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\PedidoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Cliente
Route::get('clientes', [ClienteController::class, 'index']);
Route::get('clientes/buscar/{contato}', [ClienteController::class, 'buscar']);//Contato pode ser email ou telefone
Route::delete('cliente/{id}', [ClienteController::class, 'destroy']);
Route::get('cliente/{id}', [ClienteController::class, 'show']);
Route::post('cliente', [ClienteController::class, 'store']);
Route::put('cliente/{id}', [ClienteController::class, 'update']);

//Pedidos
Route::get('pedido/cancelar/{cliente}/{id}', [PedidoController::class, 'cancel']);//Cancela o pedido do cliente, rota usada para a api
Route::get('pedidos/{cliente}', [PedidoController::class, 'index']);
Route::post('pedido/{cliente}', [PedidoController::class, 'store']);//PRODUTOS, enviar ids numa string separados por vírgula
Route::get('pedido/{id}', [PedidoController::class, 'show']);  
Route::put('pedido/{cliente}/{id}', [PedidoController::class, 'update']);//Passar o campo status, com o status que deseja.
Route::delete('pedido/{cliente}/{id}', [PedidoController::class,'destroy']);