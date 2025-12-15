<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inventaire')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

@auth
<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">Gestion Inventaire</span>

    <span class="text-white">
        {{ Auth::user()->name }}
    </span>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger btn-sm">Déconnexion</button>
    </form>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- ================= SIDEBAR ================= -->
        <div class="col-2 bg-light vh-100 p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">📊 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories">📁 Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/produits">📦 Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/fournisseurs">🚚 Fournisseurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/mouvements">🔄 Mouvements</a>
                </li>
            </ul>
        </div>

        <!-- ================= CONTENT ================= -->
        <div class="col-10 p-4">
            @yield('content')
        </div>

    </div>
</div>
@endauth


@guest
<!-- ================= PAGES AUTH ================= -->
<div class="container mt-5">
    @yield('content')
</div>
@endguest

</body>
</html>
