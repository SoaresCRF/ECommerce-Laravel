@extends('layouts.client.main')
@section('conteudo')
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2 text-capitalize">Produtos</span></h2>
            @if (!empty(session('produtoAddCarrinho')))
                <p style="color: green; font-size: 22px;">Item adicionado ao <a style="font-weight: bold; color: green;"
                        href="{{ route('clientecarrinho') }}">carrinho!</a></p>
            @endif

            @if (!empty(session('estoqueAtingido')))
                <p style="color: red; font-size: 22px;">Estoque disponível atingido. Verifique seu <a
                        style="font-weight: bold; color: red;" href="{{ route('clientecarrinho') }}">carrinho</a>
                </p>
            @endif

            @if (!empty(session('produtoNaoEncontrado')))
                <p style="color: red; font-size: 22px;">{{ session('produtoNaoEncontrado') }}</p>
            @endif
        </div>

        <div class="row px-xl-5 pb-3">
            @foreach ($allProdutos as $produto)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="/img/produtoFicticio.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3 text-capitalize">{{ $produto->nome_produto }}</h6>
                            <h6 class="text-truncate mb-3 text-capitalize">{{ $produto->fornecedor }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>R$ {{ number_format($produto->valor_venda, 2, ',', '.') }}</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            @if (session('cargo') != 'cliente' or $produto->estoque < 1)
                                @if (session('cargo') != 'cliente')
                                    <button onclick="return alert('Realize login para adicionar itens ao carrinho!')"
                                        style="all: unset; cursor: pointer; font-size: 14px"
                                        class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add ao carrinho</button>
                                @else
                                    <button onclick="return alert('Esqtoque esgotado!')"
                                        style="all: unset; cursor: pointer; font-size: 14px"
                                        class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add ao carrinho</button>
                                @endif
                            @else
                                <form action="{{ route('clienteaddcarrinho') }}" method="POST">
                                    @csrf
                                    <button style="all: unset; cursor: pointer; font-size: 14px"
                                        class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add ao carrinho</button>
                                    <input type="hidden" name="cod_produto" value="{{ $produto->cod_produto }}">
                                </form>
                            @endif
                            <span class="btn-sm text-dark p-0">Estoque: {{ $produto->estoque }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
