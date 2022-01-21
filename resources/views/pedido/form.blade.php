@extends('layouts.app')

@section('content')
    <div class="container teste">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $content_title }}</h3>
                    </div>

                    <!-- FORM -->
                    <form action="{{ url('pedido/' . $pedido->id) }}" method="POST">
                        @method('PUT')

                        <div class="card-body">
                            @csrf

                            <!-- MSG ERRO -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- //MSG ERRO -->

                            <p>{{ 'Pedido: '.$pedido->id.', criado por '.$pedido->cliente->nome.' as '.$pedido->created_at }}</p>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status">
                                    <option {{ $pedido->status == 'pendente' ? 'selected="selected"' : '' }} value="pendente">Pendente</option>
                                    <option {{ $pedido->status == 'em preparo' ? 'selected="selected"' : '' }} value="em preparo">Em Preparo</option>
                                    <option {{ $pedido->status == 'em entrega' ? 'selected="selected"' : '' }} value="em entrega">Em Entrega</option>
                                    <option {{ $pedido->status == 'entregue' ? 'selected="selected"' : '' }} value="entregue">Entregue</option>
                                    <option {{ $pedido->status == 'cancelado' ? 'selected="selected"' : '' }} value="cancelado">Cancelado</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ url('pedidos') }}" class="btn btn-success">Voltar</a>
                            <button type="submit" class="btn btn-primary">Alterar</button>
                        </div>
                    </form>
                    <!-- //FORM -->
                </div>
            </div>
        </div>
    </div>
@endsection
