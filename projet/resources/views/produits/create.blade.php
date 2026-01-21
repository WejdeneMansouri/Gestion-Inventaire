<!DOCTYPE html>
<html>
<head>
    <title>Ajouter / Modifier produit</title>
    <link rel="stylesheet" href="{{ asset('css/produit.css') }}">
</head>

<body>

<h1>Ajouter un produit</h1>

<form action="/produits" method="POST">
    @csrf

    <label>Nom :</label>
    <input type="text" name="nom"><br><br>

    <label>Description :</label>
    <textarea name="description"></textarea><br><br>

    <label>Prix :</label>
    <input type="number" name="prix" step="0.01"><br><br>

    <label>Quantité :</label>
    <input type="number" name="quantite"><br><br>

    <label>Catégorie :</label>
    <select name="categorie_id">
        @foreach($categories as $c)
            <option value="{{ $c->id }}">{{ $c->nom }}</option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>
