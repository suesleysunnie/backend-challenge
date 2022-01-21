<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Resources\Cliente as ClienteResource;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends ApiController
{

    public function index()
    {
        $clientes = Cliente::all();
        return $this->successResponse($clientes);
    }

    public function buscar($contato)
    {
        if(is_numeric($contato)){
            $cliente = Cliente::where("telefone", $contato)->first();
        }else{
            $cliente = Cliente::where("email", $contato)->first();
        }

        if($cliente){
            return $this->successResponse($cliente);
        }else{
            return $this->successResponse([], 204);
        }
    }

    public function store(Request $request)
    {
        $validator = $this->validateCliente();

        if($validator->fails()){
            return $this->errorResponse($validator->messages(), 422);
        }

        $cliente = new Cliente;
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->telefone = $request->input('telefone');
        $cliente->endereco = $request->input('endereco');

        if( $cliente->save() ){
            return $this->successResponse($cliente,'Cliente cadastrado', 201);
        }
    }
    

    public function show($id)
    {
        $cliente = Cliente::findOrFail( $id );
        
        return $this->successResponse($cliente);
    }

    
    public function update(Request $request)
    {
        $cliente = Cliente::findOrFail( $request->id );
        
        $validator = $this->validateCliente($cliente->id);
        if($validator->fails()){
            return $this->errorResponse($validator->messages(), 422);
        }

        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->telefone = $request->input('telefone');
        $cliente->endereco = $request->input('endereco');
        $cliente->save();
        
        return $this->successResponse($cliente, 'Cliente alterado', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail( $id );

        if( $cliente->delete() ){
            return $this->successResponse(null, 'Cliente removido');
        }
    }

    //Forma mais prática para padronizar mensagens de retorno
    public function validateCliente($id = ''){
        return Validator::make(request()->all(), [
            'nome' => 'required',
            'email' => 'required|email|unique:clientes,email,'.$id,
            'telefone' => 'required|unique:clientes,telefone,'.$id,
            'endereco' => 'required'
        ]);
    }
}
