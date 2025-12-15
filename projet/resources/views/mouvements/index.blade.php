<!DOCTYPE html>
<html>
<head>
    <title>Historique des mouvements</title>
</head>
<body>

<h1>Historique des mouvements</h1>

<a href="/mouvements/entree">➕ Entrée de stock</a> |
<a href="/mouvements/sortie">➖ Sortie de stock</a>

<br><br>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Produit</th>
        <th>Type</th>
        <th>Quantité</th>
        <th>Description</th>
        <th>Date</th>
    </tr>

    @foreach($mouvements as $m)
        <tr>
            <td>{{ $m->produit->nom }}</td>
            <td>{{ strtoupper($m->type) }}</td>
            <td>{{ $m->quantite }}</td>
            <td>{{ $m->description }}</td>
            <td>{{ $m->created_at }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
