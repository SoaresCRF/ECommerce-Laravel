<!DOCTYPE html>
<html lang="pt-br" style="background-color: #9A616D;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <!-- icon página -->
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/client/apple-touch-icon.png">
    <link rel="icon" type="/image/png" sizes="32x32" href="/icon/client/favicon-32x32.png">
    <link rel="icon" type="/image/png" sizes="16x16" href="/icon/client/favicon-16x16.png">
    <link rel="manifest" href="/icon/client/site.webmanifest">

    <!-- Meu estilo -->
    <link rel="stylesheet" href="/css/registrarCliente.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <section class="h-100 h-custom gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <form action="{{ route('clienteformcadastro') }}" method="post">
                                @csrf
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <h3 class="fw-normal mb-5" style="color: #C17A74;">Detalhes pessoal</h3>
                                            <div class="row">
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input required name="nome_cliente" maxlength="100"
                                                            value="{{ old('nome_cliente') }}" id="form3Examplev4"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplev4">Nome
                                                            completo</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input type="email" required name="email" maxlength="100"
                                                            value="{{ old('email') }}" id="form3Examplev4"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplev4">E-mail</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <select required name="sexo" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Informe seu sexo</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Feminino</option>
                                                    <option value="NI">Não informa</option>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input required name="cpf" id="form3Examplev2"
                                                            value="{{ old('cpf') }}" minlength="14" maxlength="14"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplev2">CPF</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input required name="celular" minlength="15" maxlength="15"
                                                            id="celular" value="{{ old('celular') }}"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplev3">Número
                                                            celular</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input required name="senha" minlength="8" maxlength="20"
                                                            title="Conter letra maiúscula, minúscula, número e símbolo"
                                                            type="password" id="password"
                                                            value="{{ old('senha') }}"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplev2">Senha</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input required minlength="8" maxlength="20"
                                                            name="confirma_senha" type="password"
                                                            id="confirm_password" value="{{ old('confirma_senha') }}"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplev3">Confirma
                                                            senha</label>
                                                    </div>
                                                </div>

                                            </div>
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

                                    <div class="col-lg-6 bg-indigo text-white">
                                        <div class="p-5">

                                            <h3 class="fw-normal mb-5">Endereço</h3>

                                            <div class="row">
                                                <div class="col-md-5 mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input required minlength="9" maxlength="9" name="cep"
                                                            onblur="pesquisacep(this.value);" id="form3Examplea4"
                                                            value="{{ old('cep') }}"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplea4">CEP</label>
                                                    </div>
                                                    <a href="#" style="color: white"
                                                        onclick="javascript:abrirEmPopup('https://buscacepinter.correios.com.br/app/localidade_logradouro/index.php', 1025, 550);">Não
                                                        sei meu CEP</a>
                                                </div>

                                                <div class="col-md-7 mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input required value="{{ old('estado') }}" minlength="2"
                                                            maxlength="2" readonly name="estado" id="uf"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplea5">Estado</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-5 mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input required name="cidade" maxlength="100"
                                                            value="{{ old('cidade') }}" readonly id="cidade"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplea7">Cidade</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-7 mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input required value="{{ old('bairro') }}" maxlength="100"
                                                            name="bairro" readonly id="bairro"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplea8">Bairro</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-5 mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input required value="{{ old('rua') }}" maxlength="100"
                                                            name="rua" readonly id="rua"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplea7">Rua</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-7 mb-9 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input required name="numero_casa" id="form3Examplea8"
                                                            value="{{ old('numero_casa') }}"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form3Examplea8">Número
                                                            casa</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-light btn-lg"
                                                data-mdb-ripple-color="dark">Cadastrar</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="/js/senhaCorresponde.js"></script>
    <script src="/js/abrirEmPopup.js"></script>
    <script src="/js/viaCep.js"></script>
    <script src="/js/mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>
