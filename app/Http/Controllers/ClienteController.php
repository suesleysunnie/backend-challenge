<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content_title = 'Lista de Clientes';
        $clientes = Cliente::simplePaginate(10);

        $data = ['content_title' => $content_title, 'clientes' => $clientes];
        
        return view('cliente.list', $data);
    }
}
