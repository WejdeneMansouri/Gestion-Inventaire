<!DOCTYPE html>
<html>
<head>
    <title>Catégories</title>
    <link rel="stylesheet" href="{{ asset('css/categorie.css') }}">
</head>

<body>

<h1>Liste des catégories</h1>

<a href="/categories/create">➕ Ajouter catégorie</a>

<ul>
    @foreach($categories as $c)
        <li>{{ $c->nom }}</li>
    @endforeach
</ul>

</body>
</html>
