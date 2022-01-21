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
                        @if($clientes)
                            <table class="table">
                                <thead>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Endereço</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->id }}</td>
                                            <td>{{ $cliente->nome }}</td>
                                            <td>{{ $cliente->email }}</td>
                                            <td>{{ $cliente->telefone }}</td>
                                            <td>{{ $cliente->endereco }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="table-control">
                                {{ $clientes->links() }}
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
