<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>E Commerce - Checkout</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- icon página -->
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/client/apple-touch-icon.png">
    <link rel="icon" type="/image/png" sizes="32x32" href="/icon/client/favicon-32x32.png">
    <link rel="icon" type="/image/png" sizes="16x16" href="/icon/client/favicon-16x16.png">
    <link rel="manifest" href="/icon/client/site.webmanifest">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/lojaCliente.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">E</span>Commerce</h1>
            </div>
            <div class="col-lg-6 col-6 text-left">
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="{{ route('clientecarrinho') }}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge"> {{ $qtdItemCarrinho }}</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categorias</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <a href="{{ route('clienteprodutos') }}" class="nav-item nav-link">Todos produtos</a>
                        <a href="{{ route('clientealimento') }}" class="nav-item nav-link">Alimentos</a>
                        <a href="{{ route('clientebebida') }}" class="nav-item nav-link">Bebidas</a>
                        <a href="{{ route('clientecelular') }}" class="nav-item nav-link">Celulares</a>
                        <a href="{{ route('clientehardware') }}" class="nav-item nav-link">Hardware</a>
                        <a href="{{ route('clientejogo') }}" class="nav-item nav-link">Jogos</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">E</span>Commerce</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('clienteprodutos') }}" class="nav-item nav-link">Home</a>
                            <a href="{{ route('clientecarrinho') }}" class="nav-item nav-link">Carrinho</a>
                            <a href="{{ route('clientecheckout') }}" class="nav-item nav-link active">Checkout</a>
                            <a href="{{ route('clientepedidos') }}" class="nav-item nav-link">Meus pedidos</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    {{ session('nome_cliente') }}</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="{{ route('clientecarrinho') }}" class="dropdown-item">Carrinho</a>
                                    <a href="{{ route('clientecheckout') }}" class="dropdown-item">Checkout</a>
                                    <a href="{{ route('clientepedidos') }}" class="dropdown-item">Meus pedidos</a>
                                    <form action="{{ route('clienteformcontadeletar') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button id="deletarConta" class="dropdown-item"
                                            onclick="return confirm('Você não será capaz de reverter isso!')">Deletar
                                            conta</button>
                                    </form>
                                    <a onclick="return confirm('Deseja realmente deslogar?')" href="{{ route('clientelogout') }}" class="dropdown-item">Sair</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('clienteprodutos') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="text-center mb-4">
        @if (!empty(session('acaoSucesso')))
            <div class="text-center mb-4">
                <p style="color: green; font-size: 22px;">{{ session('acaoSucesso') }}</p>
            </div>
        @endif

        @if (!empty(session('compraRealizada')))
            <div class="text-center mb-4">
                <p style="color: green; font-size: 20px; font-weight: bold;">Compra realizada com sucesso!</p>
                <p><a href="{{ route('clientepedidos') }}" style="color: green; font-size: 20px; ">Visualizar meus
                        pedidos</a></p>
            </div>
        @endif
    </div>

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Endereço de entrega</h4>
                    <form action="{{ route('clienteformcheckout') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input required type="email" class="form-control" maxlength="100" name="email"
                                    value="{{ $cliente->email }}" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Celular</label>
                                <input required minlength="15" maxlength="15" class="form-control" id="celular"
                                    name="celular" value="{{ $cliente->celular }}" placeholder="(xx) 9xxxx-xxxx">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>CEP</label>
                                <input required class="form-control" minlength="9" maxlength="9"
                                    onblur="pesquisacep(this.value);" id="form3Examplea4" name="cep"
                                    value="{{ $cliente->cep }}" placeholder="XXXXX-XXX">
                                <a href="#"
                                    onclick="javascript:abrirEmPopup('https://buscacepinter.correios.com.br/app/localidade_logradouro/index.php', 1025, 550);">Não
                                    sei meu CEP</a>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Estado</label>
                                <input class="form-control" minlength="2" maxlength="2" id="uf" readonly
                                    required name="estado" value="{{ $cliente->estado }}" placeholder="Estado">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Cidade</label>
                                <input class="form-control" maxlength="100" id="cidade" readonly required
                                    name="cidade" value="{{ $cliente->cidade }}" placeholder="Cidade">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bairro</label>
                                <input class="form-control" maxlength="100" id="bairro" readonly required
                                    name="bairro" value="{{ $cliente->bairro }}" placeholder="Bairro">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Rua</label>
                                <input class="form-control" maxlength="100" id="rua" readonly required
                                    name="rua" value="{{ $cliente->rua }}" placeholder="Rua">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Número casa</label>
                                <input required class="form-control" id="form3Examplea8" name="numero_casa"
                                    value="{{ $cliente->numero_casa }}">
                            </div>
                            <div class="col-md-3 form-group">
                                <div class="custom-control custom-checkbox">
                                    <button class="btn btn-block btn-primary my-3 py-3">Confirma
                                        dados</button>
                                    <input type="hidden" name="id" value="{{ $cliente->id }}">
                                </div>
                            </div>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul style="list-style: disc;">
                                @foreach ($errors->all() as $mensagemErro)
                                    <li class="text-start">{{ $mensagemErro }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Total de pedidos</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Produtos</h5>
                        @php $index = 0; @endphp
                        @foreach ($produtos as $produto)
                            <div class="d-flex justify-content-between">
                                <p class='text-capitalize'>{{ $produto->nome_produto }}</p>
                                <p>R$ {{ number_format($qtd[$index] * $produto->valor_venda, 2, ',', '.') }}</p>
                            </div>
                            @php $index++ @endphp
                        @endforeach
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">R$ {{ number_format($totalCarrinho, 2, ',', '.') }} </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Frete</h6>
                            @if ($totalCarrinho > 0)
                                <h6 class="font-weight-medium">R$ 30,00</h6>
                            @else
                                <h6 class="font-weight-medium">R$ 0,00</h6>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            @if ($totalCarrinho > 0)
                                <h5 class="font-weight-bold">R$ {{ number_format($totalCarrinho + 30, 2, ',', '.') }}
                                </h5>
                            @else
                                <h5 class="font-weight-bold">R$ 0,00</h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-footer border-secondary bg-transparent">
                        @if ($totalCarrinho > 0)
                            <form action="{{ route('clienteformcheckoutconcluircompra') }}" method="post">
                                @csrf
                                @foreach ($produtos as $produto)
                                    <input type="hidden" name="produtosIds[]" value="{{ $produto->id }}">
                                @endforeach
                                @foreach ($qtd as $quantidade)
                                    <input type="hidden" name="qtd[]" value="{{ $quantidade }}">
                                @endforeach
                                <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Concluir
                                    compra</button>
                            </form>
                        @else
                            <button onclick="return alert('Carrinho de compra vazio!')"
                                class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Concluir
                                compra</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Commerce</h1>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum
                    dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Rua 123, Feira de Santana, BR
                </p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>(75) 99999-9999</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <div class="d-flex flex-column justify-content-start">
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Links Rápidos</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="{{ route('clienteprodutos') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" style="cursor: pointer;"><i
                                    class="fa fa-angle-right mr-2"></i>Shop</a>
                            <a class="text-dark" style="cursor: pointer;"><i class="fa fa-angle-right mr-2"></i>Lorem
                                ipsum</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold">E Commerce</a>. All Rights
                    Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="/js/lojaCliente.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="/js/abrirEmPopup.js"></script>
    <script src="/js/viaCep.js"></script>
    <script src="/js/mask.js"></script>
</body>

</html>
