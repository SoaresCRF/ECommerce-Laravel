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
                    <h3 class="title has-text-grey">Editar produto</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <!-- Conteúdo -->
                    <div class="hero-body">
                        <div class="container has-text-centered">
                            <div class="column is-4 is-offset-4">
                                <div class="box">
                                    <form action="{{ route('adminformeditarproduto', $produto->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="field">
                                            <div class="control">
                                                <label for="">Cod Produto</label>
                                                <input id="animacaoInput" name="cod_produto"
                                                    value="{{ $produto->cod_produto }}" maxlength="5" class="input is-large"
                                                    placeholder="Cod produto" autofocus required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <label for="">Nome produto</label>
                                                <input id="inputDesabilitado" readonly maxlength="50"
                                                    value="{{ $produto->nome_produto }}" class="input is-large"
                                                    placeholder="Nome produto" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <label for=""> Fornecedor</label>
                                                <input id="inputDesabilitado" readonly maxlength="50"
                                                    value="{{ $produto->fornecedor }}" class="input is-large"
                                                    placeholder="Fornecedor" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <label for="">Custo Produto</label>
                                                <input id="animacaoInput" name="custo_produto"
                                                    value="{{ $produto->custo_produto }}" class="input is-large"
                                                    placeholder="Custo produto" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <label for="">Adicionar ao estoque</label>
                                                <input id="animacaoInput" name="estoque" maxlength="5" value=""
                                                    class="input is-large"
                                                    placeholder="Estoque atual: {{ $produto->estoque }}">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="control">
                                                <select name="categoria" id="animacaoInput"
                                                    style="max-width: 100%; width: 100%; height: 47.25px;">
                                                    <option value="alimento"
                                                        {{ $produto->categoria == 'alimento' ? "selected='selected'" : '' }}>
                                                        Alimento</option>
                                                    <option value="bebida"
                                                        {{ $produto->categoria == 'bebida' ? "selected='selected'" : '' }}>
                                                        Bebida</option>
                                                    <option value="celular"
                                                        {{ $produto->categoria == 'celular' ? "selected='selected'" : '' }}>
                                                        Celular</option>
                                                    <option value="hardware"
                                                        {{ $produto->categoria == 'hardware' ? "selected='selected'" : '' }}>
                                                        Hardware</option>
                                                    <option value="jogo"
                                                        {{ $produto->categoria == 'jogo' ? "selected='selected'" : '' }}>
                                                        Jogo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button id="butaoforms"
                                            class="button is-block is-link is-large is-fullwidth">Editar</button>

                                        <p style="margin-top: 10px;">
                                            <a style="text-decoration: none; color: #11101D;"
                                                href="{{ route('adminvisualizarprodutos') }}">Visualizar
                                                produtos cadastrados</a>
                                        </p>
                                    </form>
                                </div>
                                @if (!empty(session('estoqueMaximoUltrapassado')))
                                    <div class="notification is-info">
                                        <p>{{ session('estoqueMaximoUltrapassado') }}</p>
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
