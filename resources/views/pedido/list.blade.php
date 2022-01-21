@extends('layouts.app')

@section('content')
    <div class="container teste">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $content_title }}</h3>
                    </div>

                    @if(Request::is('*/abertos'))
                        <div class="header-buttons">
                            <a href="{{ url('pedidos') }}" class="btn btn-primary">Listar todos</a>
                        </div>
                    @else
                        <div class="header-buttons">
                            <a href="{{ url('pedidos/abertos') }}" class="btn btn-outline-primary">Filtrar em aberto</a>
                        </div>
                    @endif

                    <div class="card-body">
                        <!-- will be used to show any messages -->
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif

                        @if ($pedidos)
                            <table class="table">
                                <thead>
                                    <th>ID</th>
                                    <th>Criado em</th>
                                    <th>Status</th>
                                    <th>Cliente</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $pedido)
                                        <tr>
                                            <td>{{ $pedido->id }}</td>
                                            <td>{{ $pedido->created_at }}</td>
                                            <td>{{ $pedido->status }}</td>
                                            <td>{{ $pedido->cliente->nome }}</td>
                                            <td>
                                                <a class="btn btn-outline-primary"
                                                    href="{{ url('pedido/' . $pedido->id) }}">Detalhes</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-success"
                                                    href="{{ url('pedido/' . $pedido->id.'/editar') }}">Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="table-control">
                                {{ $pedidos->links() }}
                            </div>
                        @else
                            <h5>Não há registros.</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
