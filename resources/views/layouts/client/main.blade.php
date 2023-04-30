<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>E Commerce</title>
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
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>Commerce</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
            </div>
            @if (session('cargo') == 'cliente')
                <div class="col-lg-3 col-6 text-right">
                    <a href="#" class="btn border">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge"> {{ $qtdItemCarrinho }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical">
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
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">E</span>Commerce</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('clienteprodutos') }}" class="nav-item nav-link active">Home</a>
                            <a href="#categorias" class="nav-item nav-link">Shop</a>
                            @if (session('cargo') == 'cliente')
                                <a href="{{ route('clientecarrinho') }}" class="nav-item nav-link">Carrinho</a>
                                <a href="{{ route('clientecheckout') }}" class="nav-item nav-link">Checkout</a>
                                <a href="{{ route('clientepedidos') }}" class="nav-item nav-link">Meus pedidos</a>
                            @endif
                        </div>
                        @if (session('cargo') != 'cliente')
                            @if (!empty(session('contaDeletada')))
                                <p style="color: red; font-size: 20px;">{{ session('contaDeletada') }}</p>
                            @endif
                            <div class="navbar-nav ml-auto py-0">
                                <a href="{{ route('clientelogin') }}" class="nav-item nav-link">Login</a>
                                <a href="{{ route('clientecadastro') }}" class="nav-item nav-link">Registrar</a>
                            </div>
                        @else
                            <div class="navbar-nav ml-auto py-0">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                        {{ session('nome_cliente') }}</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="{{ route('clientecarrinho') }}" class="dropdown-item">Carrinho</a>
                                        <a href="{{ route('clientecheckout') }}" class="dropdown-item">Checkout</a>
                                        <a href="{{ route('clientepedidos') }}" class="dropdown-item">Meus
                                            pedidos</a>
                                        <form action="{{ route('clienteformcontadeletar') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button id="deletarConta" class="dropdown-item"
                                                onclick="return confirm('Você não será capaz de reverter isso!')">Deletar
                                                conta</button>
                                        </form>
                                        <a href="{{ route('clientelogout') }}" class="dropdown-item">Sair</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $desativado = 0;
                            $index = 0;
                        @endphp
                        @foreach ($produtosMaisComprados as $produto)
                            @if ($desativado == 0)
                                @php $desativado++; @endphp
                                <div class="carousel-item active" style="height: 410px;">
                                    <img class="img-fluid" src="/img/produtoFicticio.jpg" alt="Image">
                                    <div
                                        class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">destaques
                                            </h4>
                                            <h3
                                                class="display-4 text-white font-weight-semi-bold mb-4 text-capitalize">
                                                {{ $produto->nome_produto }}
                                            </h3>
                                            <h3
                                                class="display-4 text-white font-weight-semi-bold mb-4 text-capitalize">
                                                {{ $produto->fornecedor }}
                                            </h3>
                                            @if (session('cargo') != 'cliente' or $produtos[$index]->estoque < 1)
                                                @if (session('cargo') != 'cliente')
                                                    <button
                                                        onclick="return alert('Realize login para adicionar itens ao carrinho!')"
                                                        style=" cursor: pointer;"
                                                        class="btn btn-light py-2 px-3 text-uppercase">compre
                                                        agora</button>
                                                @else
                                                    <button onclick="return alert('Esqtoque esgotado!')"
                                                        style=" cursor: pointer;"
                                                        class="btn btn-light py-2 px-3 text-uppercase">compre
                                                        agora</button>
                                                @endif
                                            @else
                                                <form action="{{ route('clienteaddcarrinho') }}" method="POST">
                                                    @csrf
                                                    <button style=" cursor: pointer;"
                                                        class="btn btn-light py-2 px-3 text-uppercase">compre
                                                        agora</button>
                                                    <input type="hidden" name="cod_produto"
                                                        value="{{ $produto->cod_produto }}">
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="carousel-item" style="height: 410px;">
                                    <img class="img-fluid" src="/img/produtoFicticio.jpg" alt="Image">
                                    <div
                                        class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">Destaques
                                            </h4>
                                            <h3
                                                class="display-4 text-white font-weight-semi-bold mb-4 text-capitalize">
                                                {{ $produto->nome_produto }}
                                            </h3>
                                            <h3
                                                class="display-4 text-white font-weight-semi-bold mb-4 text-capitalize">
                                                {{ $produto->fornecedor }}
                                            </h3>
                                            @if (session('cargo') != 'cliente' or $produtos[$index]->estoque < 1)
                                                @if (session('cargo') != 'cliente')
                                                    <button
                                                        onclick="return alert('Realize login para adicionar itens ao carrinho!')"
                                                        style=" cursor: pointer;"
                                                        class="btn btn-light py-2 px-3 text-uppercase">compre
                                                        agora</button>
                                                @else
                                                    <button onclick="return alert('Esqtoque esgotado!')"
                                                        style=" cursor: pointer;"
                                                        class="btn btn-light py-2 px-3 text-uppercase">compre
                                                        agora</button>
                                                @endif
                                            @else
                                                <form action="{{ route('clienteaddcarrinho') }}" method="POST">
                                                    @csrf
                                                    <button style=" cursor: pointer;"
                                                        class="btn btn-light py-2 px-3 text-uppercase">compre
                                                        agora</button>
                                                    <input type="hidden" name="cod_produto"
                                                        value="{{ $produto->cod_produto }}">
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @php $index++; @endphp
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5" id="categorias">
        <div class="row px-xl-5 pb-3">
            @foreach ($categorias as $categoria)
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right">{{ $categoria->qtdCategoria }} Produtos</p>
                        <a href="{{ route('cliente' . "$categoria->categoria") }}"
                            class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="/img/produtoFicticio.jpg" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0 text-capitalize">{{ $categoria->categoria }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->
    @yield('conteudo')

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
</body>

</html>
