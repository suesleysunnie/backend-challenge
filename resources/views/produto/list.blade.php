@extends('layouts.app')

@section('content')
    <div class="container teste">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $content_title }}</h3>
                    </div>


                    <div class="header-buttons">
                        <a href="{{ url('produto/novo') }}" class="btn btn-primary">Novo Produto</a>
                    </div>

                    <div class="card-body">
                        <!-- will be used to show any messages -->
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif

                        @if ($produtos)
                            <table class="table">
                                <thead>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th colspan="2"></th>
                                </thead>
                                <tbody>
                                    @foreach ($produtos as $produto)
                                        <tr>
                                            <td>{{ $produto->id }}</td>
                                            <td>{{ $produto->nome }}</td>
                                            <td>R$ {{ $produto->preco }}</td>
                                            <td>
                                                <a class="btn btn-outline-success"
                                                    href="{{ url('produto/' . $produto->id . '/editar/') }}">Editar</a>
                                            </td>
                                            <td>
                                                <form action="{{ url('produto/' . $produto->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    
                                                    <button class="btn btn-outline-danger">Remover</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="table-control">
                                {{ $produtos->links() }}
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
