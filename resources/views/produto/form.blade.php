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
                        @if(Request::is('*/editar'))
                            <form action="{{ url('produto/'.$produto->id) }}" method="POST">
                            @method('PUT')
                        @else
                            <form action="{{ url('produto') }}" method="POST">
                        @endif

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
                            
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" 
                                value="{{ isset($produto->nome) ? $produto->nome : ''  }}"
                                    placeholder="Nome do produto">
                            </div>
                            <div class="form-group">
                                <label for="preco">Preço</label>
                                <input type="text" onkeypress="return onlynumber();" 
                                class="form-control" name="preco" id="preco"
                                value="{{ isset($produto->preco) ? $produto->preco : ''  }}">
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ url('produtos') }}" class="btn btn-success">Voltar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                    <!-- //FORM -->
                </div>
            </div>
        </div>
    </div>
@endsection
