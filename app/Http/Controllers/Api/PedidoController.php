<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePedidoRequest;
use App\Http\Resources\Pedido as PedidoResource;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    
    public function index($cliente)
    {
        $client = Cliente::findOrFail($cliente); //Valida se o cliente existe;

        $pedidos = Pedido::where('cliente_id', $client->id)->with('produtos')->orderBy('id', 'DESC')->get();
        return $pedidos;
    }
    
    public function store($cliente, Request $request)
    {
        $client = Cliente::findOrFail( $cliente ); 

        //Validar produtos
        $request->validate([
            'produtos' => 'required',
        ]);

        //Filtrar entrada de produtos
        $id_produtos = array_filter(explode(",", trim($request->input('produtos'))));
        $produtos = Produto::whereIn('id', $id_produtos)->get();

        //Se todos os produtos informados foram válidos
        if(count($produtos) == count($id_produtos)){
            $pedido = new Pedido;
            $pedido->cliente_id = $client->id;

            if( $pedido->save() ){
                foreach($produtos as $produto){
                    $pedido->produtos()->attach($produto);
                }

                return $pedido;
            }
        }else{
            return []; //Tratar erro e exibir que algum dos produtos escolhido estava incorreto
        }
    }
    
    public function show($id)
    {
        $pedidos = Pedido::where('id', $id)->with(['produtos', 'cliente'])->orderBy('id', 'DESC')->firstOrFail();
        return $pedidos;
    }

    public function cancel($cliente, $id)
    {
        $client = Cliente::findOrFail($cliente);
        $pedido = Pedido::findOrFail($id);

        //Se o cliente é dono pedido, senão não tem permissão
        if($client->id == $pedido->cliente_id){
            
            $pedido->status = 'cancelado';

            if( $pedido->save() ){
                return $pedido;
            }
        }else{
            return [];
        }
    }
    
    public function update($cliente, UpdatePedidoRequest $request, $id)
    {
        $client = Cliente::findOrFail($cliente);
        $pedido = Pedido::findOrFail($id);

        //Se o cliente é dono pedido, senão não tem permissão
        if($client->id == $pedido->cliente_id){
            
            $pedido->status = $request->status;

            if( $pedido->save() ){
                return $pedido;
            }
        }else{
            return [];
        }
    }
    
    public function destroy($cliente, $id)
    {
        $client = Cliente::findOrFail($cliente);
        $pedido = Pedido::findOrFail($id);

        //Se o cliente é dono pedido, senão não tem permissão
        if($client->id == $pedido->cliente_id){
            if( $pedido->delete() ){
                return $pedido;
            }
        }else{
            return [];
        }
    }
}
