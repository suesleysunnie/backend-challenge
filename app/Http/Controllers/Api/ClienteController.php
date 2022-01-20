<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Resources\Cliente as ClienteResource;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        return ClienteResource::collection($clientes);
    }

    public function buscar($contato)
    {
        if(is_numeric($contato)){
            $cliente = Cliente::where("telefone", $contato)->first();
        }else{
            $cliente = Cliente::where("email", $contato)->first();
        }

        if($cliente){
            return new ClienteResource( $cliente );
        }else{
            return [];
        }
    }

    public function store(StoreClienteRequest $request)
    {
        $cliente = new Cliente;
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->telefone = $request->input('telefone');
        $cliente->endereco = $request->input('endereco');

        if( $cliente->save() ){
            return new ClienteResource( $cliente );
        }
    }
    

    public function show($id)
    {
        $cliente = Cliente::findOrFail( $id );
        return new ClienteResource( $cliente );
    }

    
    public function update(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:clientes,email,'.$request->id,
            'telefone' => 'required|unique:clientes,telefone,'.$request->id,
            'endereco' => 'required'
        ]);

        $cliente = Cliente::findOrFail( $request->id );
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->telefone = $request->input('telefone');
        $cliente->endereco = $request->input('endereco');

        if( $cliente->save() ){
            return new ClienteResource( $cliente );
        }
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
            return new ClienteResource( $cliente );
        }
    }
}
