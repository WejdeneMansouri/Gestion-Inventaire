<!DOCTYPE html>
<html>
<head>
    <title>Ajouter / Modifier produit</title>
    <link rel="stylesheet" href="{{ asset('css/produit.css') }}">
</head>

<body>

<h1>Modifier le produit : {{ $produit->nom }}</h1>

<form action="/produits/{{ $produit->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nom :</label>
    <input type="text" name="nom" value="{{ $produit->nom }}"><br><br>

    <label>Description :</label>
    <textarea name="description">{{ $produit->description }}</textarea><br><br>

    <label>Prix :</label>
    <input type="number" name="prix" step="0.01" value="{{ $produit->prix }}"><br><br>

    <label>Quantité :</label>
    <input type="number" name="quantite" value="{{ $produit->quantite }}"><br><br>

    <label>Catégorie :</label>
    <select name="categorie_id">
        @foreach($categories as $c)
            <option value="{{ $c->id }}" @if($c->id == $produit->categorie_id) selected @endif>
                {{ $c->nom }}
            </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Mettre à jour</button>
</form>

</body>
</html>
