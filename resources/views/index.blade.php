<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>LOGIN ADMINSTRAÇÃO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- icon página-->
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/admin/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/admin/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/admin/favicon-16x16.png">
    <link rel="manifest" href="/icon/admin/site.webmanifest">
</head>

<body>
    <div class="login-form">
        <div class="text">
            <p>ADMINSTRAÇÃO</p>
        </div>
        <form action="formlogin" method="POST">
            @csrf
            <div class="field">
                <div class="fas fa-solid fa-user"></div>
                <input name="usuario" minlength="4" maxlength="20" value="{{ old('usuario') }}" placeholder="Usuário"
                    autofocus>
            </div>
            <div class="field">
                <div class="fas fa-lock"></div>
                <input maxlength="4" maxlength="4" name="senha" type="password" placeholder="Senha">
            </div>
            <button type="submit">ENTRAR</button>
            <a style="text-decoration: none;" href="{{ route('clienteprodutos') }}">
                <p style="color: #868686; margin-top: 10px;">Vistar loja</p>
            </a>
        </form>
        @if (!empty(session('erroUsuario')))
            <div class="alert alert-danger text-center">
                <p>{{ session('erroUsuario') }}</p>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
