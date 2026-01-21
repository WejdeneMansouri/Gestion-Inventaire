<!DOCTYPE html>
<html>
<head>
    <title>Produits</title>
    <link rel="stylesheet" href="{{ asset('css/produit.css') }}">
</head>


<body>

<h1>Liste des produits</h1>

<a href="/produits/create">➕ Ajouter un produit</a>
<br><br>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Catégorie</th>
        <th>Actions</th>
    </tr>

    @foreach($produits as $p)
        <tr>
            <td>{{ $p->nom }}</td>
            <td>{{ $p->prix }} DT</td>
            <td>{{ $p->quantite }}</td>
            <td>{{ $p->categorie->nom }}</td>
            <td>
                <a href="/produits/{{ $p->id }}/edit">Modifier</a>

                <form action="/produits/{{ $p->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Supprimer ?')">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>
