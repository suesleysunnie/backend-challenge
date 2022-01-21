<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content_title = 'Produtos - Listar';
        $produtos = Produto::simplePaginate(10);
        $data = ['content_title' => $content_title, 'produtos' => $produtos];
        
        return view('produto.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Dados da página
        $content_title = 'Produtos - Novo';
        $data = ['content_title' => $content_title];

        return view('produto.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|regex:/^\d{1,10}(\.\d{1,2})?$/'
        ]);

        $produto = new Produto();
        $produto->nome = $request->input('nome');
        $produto->preco = $request->input('preco');
        $produto->save();

        Session::flash('message', 'Produto cadastrado com sucesso!');
        return Redirect::to('produtos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content_title = 'Produtos - Editar';
        $produto = Produto::findOrFail($id);

        $data = ['content_title' => $content_title, 'produto' => $produto];
        return view('produto.form', $data);
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
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|regex:/^\d{1,10}(\.\d{1,2})?$/'
        ]);

        $produto = Produto::findOrFail($id);
        $produto->nome = $request->input('nome');
        $produto->preco = $request->input('preco');
        $produto->update();

        Session::flash('message', 'Produto atualizado com sucesso!');
        return Redirect::to('produtos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        Session::flash('message', 'Produto removido!');
        return Redirect::to('produtos');
    }
}
