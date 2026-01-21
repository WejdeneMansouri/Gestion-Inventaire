<!DOCTYPE html>
<html>
<head>
    <title>Catégories</title>
    <link rel="stylesheet" href="{{ asset('css/categorie.css') }}">
</head>

<body>

<h1>Ajouter une catégorie</h1>

<form action="/categories" method="POST">
    @csrf
    <input type="text" name="nom" placeholder="Nom de catégorie">
    <button type="submit">Enregistrer</button>
</form>

</body>
</html>
