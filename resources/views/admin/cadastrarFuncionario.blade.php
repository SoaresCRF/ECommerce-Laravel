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
                    <h3 class="title has-text-grey">Cadastrar funcionário</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <!-- Conteúdo -->
                    <div class="hero-body">
                        <div class="container has-text-centered">
                            <div class="column is-4 is-offset-4">
                                <div class="box">
                                    <form action="{{ route('adminformcadastrarfuncionario') }}" method="POST">
                                        @csrf
                                        <div class="field">
                                            <div class="control">
                                                <label for="">Usuário</label>
                                                <input
                                                    title="Entre 4 e 20 caracteres. Somente letras minúsculas, números e sublinhado. Não pode terminar com sublinhado."
                                                    minlength="4" maxlength="20" id="animacaoInput" name="usuario"
                                                    value="{{ old('usuario') }}" class="input is-large"
                                                    placeholder="Usuário" autofocus required>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="control">
                                                <label for="">Senha</label>
                                                <input minlength="4" maxlength="4" id="animacaoInput" name="senha"
                                                    type="password" class="input is-large" placeholder="Senha" required>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="control">
                                                <fieldset><span style="font-weight: bold; font-size: 16px;">Cargo</span>
                                                </fieldset>
                                                <input type="radio" name="cargo" value="dono"> Dono <br>
                                                <input type="radio" name="cargo" value="gerente"> Gerente
                                            </div>
                                        </div>
                                        <button id="butaoforms"
                                            class="button is-block is-link is-large is-fullwidth">Cadastrar</button>
                                        <p style="margin-top: 10px; "><a style="text-decoration: none; color: #11101D;"
                                                href="{{ route('adminvisualizarfuncionarios') }}">Visualizar funcionários
                                                cadastrados</a>
                                        </p>
                                    </form>
                                </div>
                                @if (!empty(session('funcionarioCadastrado')))
                                    <div class="notification is-success">
                                        <p>{{ session('funcionarioCadastrado') }}</p>
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
