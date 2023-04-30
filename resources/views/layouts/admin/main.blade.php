<!DOCTYPE html>
<html lang="pt-br" dir="ltr" style="background-color: #E4E9F7;">

<head>
    <meta charset="UTF-8">
    <title>Administração</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- icon página-->
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/admin/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/admin/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/admin/favicon-16x16.png">
    <link rel="manifest" href="/icon/admin/site.webmanifest">

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Meu css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Sidebar css -->
    <link rel="stylesheet" href="/css/sidebar.css">
    <!-- Bulma css -->
    <link rel="stylesheet" href="/css/bulma.min.css" />
    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">E-Commerce</span>
        </div>
        <ul class="nav-links">
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Produto</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Produto</a></li>
                    <li><a href="{{ route('adminvisualizarprodutos') }}">Visualizar</a></li>
                    @if (session('cargo') == 'dono')
                        <li><a href="{{ route('admincadastrarproduto') }}">Cadastrar</a></li>
                    @endif
                </ul>
            </li>

            @if (session('cargo') == 'dono')
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bi bi-person'></i>
                            <span class="link_name">Funcionários</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Funcionários</a></li>
                        <li><a href="{{ route('adminvisualizarfuncionarios') }}">Visualizar</a></li>
                        <li><a href="{{ route('admincadastrarfuncionario') }}">Cadastrar</a></li>
                    </ul>
                </li>

                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bi bi-lightning'></i>
                            <span class="link_name">Visão rápida</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Visão rápida</a></li>
                        <li><a href="{{ route('admintopdia') }}">Top do dia</a></li>
                        <li><a href="{{ route('admintopmes') }}">Top do mês</a></li>
                        <li><a href="{{ route('admintopgeral') }}">Top geral</a></li>
                    </ul>
                </li>

                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bi bi-flag'></i>
                            <span class="link_name">Relatório</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Relatório</a></li>
                        <li><a href="{{ route('adminrelatoriodia') }}">Top do dia</a></li>
                        <li><a href="{{ route('adminrelatoriomes') }}">Top do mês</a></li>
                        <li><a href="{{ route('adminrelatoriogeral') }}">Top geral</a></li>
                    </ul>
                </li>

                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bi bi-flag'></i>
                            <span class="link_name">Clientes</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Clientes</a></li>
                        <li><a href="{{ route('adminclienteestado') }}">Por estado</a></li>
                    </ul>
                </li>
            @endif
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="/img/profile.png" alt="profileImg">
                    </div>
                    <div class="name-job">
                        @if (session('cargo') == 'dono')
                            <div class="profile_name">Dono</div>
                        @else
                            <div class="profile_name">Gerente</div>
                        @endif
                    </div>
                    <a href="{{ route('adminlogout') }}">
                        <i title="Sair" class='bx bx-log-out'></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    @yield('conteudo')

    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</body>

</html>
