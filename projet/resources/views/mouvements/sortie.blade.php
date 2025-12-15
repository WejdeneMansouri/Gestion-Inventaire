<!DOCTYPE html>
<html>
<head>
    <title>Sortie de stock</title>
</head>
<body>

<h1>Sortie de stock</h1>

<form action="/mouvements" method="POST">
    @csrf

    <input type="hidden" name="type" value="sortie">

    <label>Produit :</label>
    <select name="produit_id">
        @foreach($produits as $p)
            <option value="{{ $p->id }}">{{ $p->nom }} (Stock: {{ $p->quantite }})</option>
        @endforeach
    </select>
    <br><br>

    <label>Quantité :</label>
    <input type="number" name="quantite" min="1">
    <br><br>

    <label>Description :</label>
    <textarea name="description"></textarea>
    <br><br>

    <button type="submit">Valider la sortie</button>
</form>

</body>
</html>
