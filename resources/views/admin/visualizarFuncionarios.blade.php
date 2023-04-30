@extends('layouts.admin.main')

@section('conteudo')
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>
        <div class="container-fluid" style="width: inherit;">
            <!-- Pode tirar o inherit -->
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    @if (!empty(session('acaoSucesso')))
                        <div class="notification is-success">
                            <p>{{ session('acaoSucesso') }}</p>
                        </div>
                    @endif

                    @if (!empty(session('funcionarioNaoEncontrado')))
                        <div class="notification is-info">
                            <p>{{ session('funcionarioNaoEncontrado') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <!-- Conteúdo -->
                    <div class="table-responsive">
                        <table id="visualizar-funcionario" class="display table" style="width:100%">
                            <thead class="table-dark">
                                <tr class='text-capitalize'>
                                    <th id="tabela-head-white" scope="col">#</th>
                                    <th id="tabela-head-white" scope="col">Usuário</th>
                                    <th id="tabela-head-white" scope="col">Senha</th>
                                    <th id="tabela-head-white" scope="col">Cargo</th>
                                    <th id="tabela-head-white" scope="col">Status</th>
                                    <th id="tabela-head-white" scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($funcionarios as $funcionario)
                                    <tr>
                                        @if ($funcionario->ativo == 1)
                                            <th class="table-success" scope="row">{{ $funcionario->id }}</th>
                                            <td class="table-success">{{ $funcionario->usuario }}</td>
                                            <td class="table-success">{{ $funcionario->senha }}</td>
                                            <td class="table-success">{{ $funcionario->cargo }}</td>
                                            <td class="table-success">
                                                <form action="{{ route('adminformstatusfuncionario', $funcionario->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class='close'><span style='color: gray; font-size: 15px;'>
                                                            Desativar</span></button>
                                                </form>
                                            </td>
                                            <td class="table-success">
                                                <form action="{{ route('adminformdeletarfuncionario', $funcionario->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class='close'><i id="tabela-deletar" style="font-size: 15px;"
                                                            class="fa-solid fa-x"></i></button>
                                                </form>
                                            </td>
                                        @else
                                            <th class="table-secondary" scope="row">{{ $funcionario->id }}</th>
                                            <td class="table-secondary">{{ $funcionario->usuario }}</td>
                                            <td class="table-secondary">{{ $funcionario->senha }}</td>
                                            <td class="table-secondary">{{ $funcionario->cargo }}</td>
                                            <td class="table-secondary">
                                                <form action="{{ route('adminformstatusfuncionario', $funcionario->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class='close'><span style='color: green; font-size: 15px;'>
                                                            Ativar</span></button>
                                                </form>
                                            </td>
                                            <td class="table-secondary">
                                                <form action="{{ route('adminformdeletarfuncionario', $funcionario->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class='close'><i id="tabela-deletar" style="font-size: 15px;"
                                                            class="fa-solid fa-x"></i></button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#visualizar-funcionario').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                }
            });
        });
    </script>
@endsection
