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

                    @if (!empty(session('produtoNaoEncontrado')))
                        <div class="notification is-info">
                            <p>{{ session('produtoNaoEncontrado') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <!-- Conteúdo -->
                    <div class="table-responsive">
                        <table id="visualizar-produtos" class="display table" style="width:100%">
                            <thead class="table-dark">
                                <tr class='text-capitalize'>
                                    <th id="tabela-head-white" scope="col">Cod</th>
                                    <th id="tabela-head-white" scope="col">Nome</th>
                                    <th id="tabela-head-white" scope="col">Fornecedor</th>
                                    <th id="tabela-head-white" scope="col">Custo do produto</th>
                                    <th id="tabela-head-white" scope="col">Valor de venda</th>
                                    <th id="tabela-head-white" scope="col">Estoque</th>
                                    <th id="tabela-head-white" scope="col">Categoria</th>
                                    @if (session('cargo') == 'dono')
                                        <th id="tabela-head-white" scope="col">&nbsp;</th>
                                        <th id="tabela-head-white" scope="col">&nbsp;</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                    @if ($produto->estoque <= 10)
                                        @php  $statusRowTable = 'table-danger' @endphp
                                    @elseif ($produto->estoque <= 30)
                                        @php  $statusRowTable = 'table-warning' @endphp
                                    @else
                                        @php  $statusRowTable = 'table-success' @endphp
                                    @endif

                                    <tr class='text-capitalize'>
                                        <th class={{ $statusRowTable }} scope="row">{{ $produto->cod_produto }}</th>
                                        <td class={{ $statusRowTable }}>{{ $produto->nome_produto }}</td>
                                        <td class={{ $statusRowTable }}>{{ $produto->fornecedor }}</td>
                                        <td class={{ $statusRowTable }}>
                                            {{ number_format($produto->custo_produto, 2, ',', '.') }}</td>
                                        <td class={{ $statusRowTable }}>
                                            {{ number_format($produto->valor_venda, 2, ',', '.') }}</td>
                                        <td class={{ $statusRowTable }}>{{ $produto->estoque }}</td>
                                        <td class={{ $statusRowTable }}>{{ $produto->categoria }}</td>
                                        @if (session('cargo') == 'dono')
                                            <td class={{ $statusRowTable }}>
                                                <form action="{{ route('adminformdeletarproduto', $produto->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        onclick="return confirm('Deseja realmente deletar este produto? \n\n{{ ucwords($produto->nome_produto) }} \n{{ ucwords($produto->fornecedor) }}')"
                                                        class='close'><i id="tabela-deletar" style="font-size: 15px;"
                                                            class="fa-solid fa-x"></i></button>
                                                </form>
                                            </td>

                                            <td class={{ $statusRowTable }}>
                                                <form action="{{ route('admineditarproduto', $produto->id) }}"
                                                    method="get">
                                                    @csrf
                                                    <button class='close'><i id="tabela-editar" style="font-size: 15px;"
                                                            class="fa-regular fa-pen-to-square"></i></button>
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
            $('#visualizar-produtos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                }
            });
        });
    </script>
@endsection
