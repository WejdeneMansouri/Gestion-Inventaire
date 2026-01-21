<!DOCTYPE html>
<html>
<head>
    <title>Entrée / Sortie de stock</title>
    <link rel="stylesheet" href="{{ asset('css/mouvement.css') }}">
</head>

<body>

<h1>Entrée de stock</h1>

<form action="/mouvements" method="POST">
    @csrf

    <input type="hidden" name="type" value="entree">

    <label>Produit :</label>
    <select name="produit_id">
        @foreach($produits as $p)
            <option value="{{ $p->id }}">{{ $p->nom }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Quantité :</label>
    <input type="number" name="quantite" min="1">
    <br><br>

    <label>Description :</label>
    <textarea name="description"></textarea>
    <br><br>

    <button type="submit">Valider l'entrée</button>
</form>

</body>
</html>
