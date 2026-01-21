<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Connexion')</title>

    <!-- Bootstrap ONLY -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Login -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height:100vh;">

    @yield('content')

</body>
</html>
