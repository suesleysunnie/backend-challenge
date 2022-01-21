<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content_title = 'Pedidos - Listar';
        $pedidos = Pedido::with('cliente')->with('produtos')->simplePaginate(15); 
        $data = ['content_title' => $content_title, 'pedidos' => $pedidos];
        
        return view('pedido.list', $data);
    }

    public function abertos()
    {
        $content_title = 'Pedidos - Listar (em aberto)';
        $pedidos = Pedido::ativos()->with('cliente')->with('produtos')->simplePaginate(15); //Remove os entregues e cancelados;
        $data = ['content_title' => $content_title, 'pedidos' => $pedidos];
        
        return view('pedido.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $content_title = 'Pedidos - Detalhes';
        $pedido = Pedido::with('cliente')->with('produtos')->findOrFail($id); 
        $data = ['content_title' => $content_title, 'pedido' => $pedido];
        
        return view('pedido.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content_title = 'Pedidos - Editar';
        $pedido = Pedido::findOrFail($id); 
        $data = ['content_title' => $content_title, 'pedido' => $pedido];
        
        return view('pedido.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->status = $request->input('status');
        $pedido->update();

        Session::flash('message', 'Pedido atualizado com sucesso!');
        return Redirect::to('pedidos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
