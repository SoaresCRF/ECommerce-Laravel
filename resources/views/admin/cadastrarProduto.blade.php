@extends('layouts.admin.main')

@section('conteudo')
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>

        <div class="container-fluid" style="width: inherit;">
            <!-- Pode tirar o inherit -->
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Cadastrar produto</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <!-- Conteúdo -->
                    <div class="hero-body">
                        <div class="container has-text-centered">
                            <div class="column is-4 is-offset-4">
                                <div class="box">
                                    <form action="{{ route('adminformcadastrarproduto') }}" method="POST">
                                        @csrf
                                        <div class="field">
                                            <div class="control">
                                                <label for="">Cod Produto</label>
                                                <input id="animacaoInput" name="cod_produto"
                                                    value="{{ old('cod_produto') }}" class="input is-large"
                                                    placeholder="Cod produto" maxlength="5" autofocus required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <label for="">Nome produto</label>
                                                <input id="animacaoInput" name="nome_produto" maxlength="50"
                                                    value="{{ old('nome_produto') }}" class="input is-large"
                                                    placeholder="Nome produto" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <label for=""> Fornecedor</label>
                                                <input id="animacaoInput" name="fornecedor" maxlength="50"
                                                    value="{{ old('fornecedor') }}" class="input is-large"
                                                    placeholder="Fornecedor" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <label for="">Custo Produto</label>
                                                <input id="animacaoInput" name="custo_produto"
                                                    value="{{ old('custo_produto') }}" class="input is-large"
                                                    placeholder="Custo produto" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <label for="">Estoque</label>
                                                <input id="animacaoInput" name="estoque" value="{{ old('estoque') }}"
                                                maxlength="5" class="input is-large" placeholder="Estoque" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <select name="categoria" id="animacaoInput"
                                                    style="max-width: 100%; width: 100%; height: 47.25px;">
                                                    <option value="alimento" selected>Alimento</option>
                                                    <option value="bebida">Bebida</option>
                                                    <option value="celular">Celular</option>
                                                    <option value="hardware">Hardware</option>
                                                    <option value="jogo">Jogo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button id="butaoforms"
                                            class="button is-block is-link is-large is-fullwidth">Cadastrar</button>

                                        <p style="margin-top: 10px;">
                                            <a style="text-decoration: none; color: #11101D;"
                                                href="{{ route('adminvisualizarprodutos') }}">Visualizar
                                                produtos cadastrados</a>
                                        </p>
                                    </form>
                                </div>
                                @if (!empty(session('acaoSucesso')))
                                    <div class="notification is-success">
                                        <p>{{ session('acaoSucesso') }}</p>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="notification is-info">
                                        <ul style="list-style: disc;">
                                            @foreach ($errors->all() as $mensagemErro)
                                                <li class="text-start">{{ $mensagemErro }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
