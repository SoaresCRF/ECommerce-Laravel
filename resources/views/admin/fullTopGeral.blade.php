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
                    <h3 class="title has-text-grey">Top Geral</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <!-- Conteúdo -->

                    @if ($produtoTopGeral)
                        <div class="table-responsive">
                            <table id="top-dia" class="display table" style="width:100%">
                                <thead class="table-dark">
                                    <tr class='text-capitalize'>
                                        <th id="tabela-head-white" scope="col">Produto</th>
                                        <th id="tabela-head-white" scope="col">Fornecedor</th>
                                        <th id="tabela-head-white" scope="col">Quantidade comprada</th>
                                        <th id="tabela-head-white" scope="col">Total de vendas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produtoTopGeral as $produto)
                                        <tr class='text-capitalize'>
                                            <th class="table-success" scope="row">{{ $produto->nome_produto }}</th>
                                            <td class="table-success">{{ $produto->fornecedor }}</td>
                                            <td class="table-success">{{ $produto->qtdComprada }}</td>
                                            <td class="table-success">
                                                R$ {{ number_format($produto->totalVenda, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class='alert alert-danger d-flex align-items-center' role='alert'>
                            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img'
                                aria-label='Danger:'>
                                <use xlink:href='#exclamation-triangle-fill' />
                            </svg>
                            <div> Nenhuma venda realizada!</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#top-dia').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                }
            });
        });
    </script>
@endsection
