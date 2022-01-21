@extends('layouts.app')

@section('content')
    <div class="container teste">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $content_title }}</h3>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>
                                    <h2>Pedido: {{ $pedido->id }}</h2>
                                </th>
                            </thead>
                            <tbody>
                                <tr class="thead">
                                    <th>Criado Em</th>
                                    <th>Atualização</th>
                                    <th>Status</th>
                                </tr>
                                <tr>
                                    <td>{{ $pedido->created_at }}</td>
                                    <td>{{ $pedido->updated_at }}</td>
                                    <td>{{ $pedido->status }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <th>Cliente:</th>
                            </thead>
                            <tbody>
                                <tr class="thead">
                                    <td colspan="5">Cliente</td>
                                </tr>
                                <tr>
                                    <td>{{ $pedido->cliente->id }}</td>
                                    <td colspan="2">{{ $pedido->cliente->nome }}</td>
                                    <td>{{ $pedido->cliente->telefone }}</td>
                                    <td>{{ $pedido->cliente->endereco }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <th>Produtos</th>
                            </thead>
                            <tbody>
                                <tr class="thead">
                                    <td>ID</td>
                                    <td>Nome</td>
                                    <td>Preço</td>
                                </tr>
                                @foreach ($pedido->produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->id }}</td>
                                        <td>{{ $produto->nome }}</td>
                                        <td>R$ {{ $produto->preco }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
