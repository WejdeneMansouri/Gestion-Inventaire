<!DOCTYPE html>
<html>
<head>
    <title>Catégories</title>
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
