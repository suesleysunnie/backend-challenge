<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pedido as PedidoResource;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends ApiController
{
    
    public function index($cliente)
    {
        $client = Cliente::findOrFail($cliente); //Valida se o cliente existe;

        $pedidos = Pedido::where('cliente_id', $client->id)->with('produtos')->orderBy('id', 'DESC')->get();
        return $this->successResponse($pedidos);
    }
    
    public function store($cliente, Request $request)
    {
        $client = Cliente::findOrFail( $cliente ); 

        $validator = $this->validatePedido();
        if($validator->fails()){
            return $this->errorResponse($validator->messages(), 422);
        }

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

                return $this->successResponse($pedido,'Pedido Cadastrado', 201);
            }
        }else{
            //return []; //Tratar erro e exibir que algum dos produtos escolhido estava incorreto
            return $this->errorResponse('Um ou mais códigos de produto infomados são inválidos.', 422);
        }
    }
    
    public function show($id)
    {
        $pedidos = Pedido::where('id', $id)->with(['produtos', 'cliente'])->orderBy('id', 'DESC')->firstOrFail();
        return $this->successResponse($pedidos);
    }

    public function cancel($cliente, $id)
    {
        $client = Cliente::findOrFail($cliente);
        $pedido = Pedido::findOrFail($id);

        //Se o cliente é dono pedido, senão não tem permissão
        if($client->id == $pedido->cliente_id){
            
            $pedido->status = 'cancelado';

            if( $pedido->save() ){
                return $this->successResponse($pedido,'Pedido cancelado', 201);
            }
        }else{
            return $this->errorResponse('Você não tem permissão para alterar o pedido', 401);
        }
    }
    
    public function update($cliente, UpdatePedidoRequest $request, $id)
    {
        $client = Cliente::findOrFail($cliente);
        $pedido = Pedido::findOrFail($id);

        //Se o cliente é dono pedido, senão não tem permissão
        if($client->id == $pedido->cliente_id){
            
            $pedido->status = $request->status;

            if( $pedido->update() ){
                return $this->successResponse($pedido, 'Pedido Alterado', 204);
            }
        }else{
            return $this->errorResponse('Você não tem permissão para alterar o pedido', 401);
        }
    }
    
    public function destroy($cliente, $id)
    {
        $client = Cliente::findOrFail($cliente);
        $pedido = Pedido::findOrFail($id);

        //Se o cliente é dono pedido, senão não tem permissão
        if($client->id == $pedido->cliente_id){
            if( $pedido->delete() ){
                return $this->successResponse(null, 'Pedido removido');
            }
        }else{
            return $this->errorResponse('Você não tem permissão para alterar o pedido', 401);
        }
    }

    //Forma mais prática para padronizar mensagens de retorno
    public function validatePedido(){
        return Validator::make(request()->all(), [
            'produtos' => 'required'
        ]);
    }
}
