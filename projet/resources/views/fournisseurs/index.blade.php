<!DOCTYPE html>
<html>
<head>
    <title>Fournisseurs</title>
</head>
<body>

<h1>Liste des fournisseurs</h1>

<a href="/fournisseurs/create">➕ Ajouter un fournisseur</a>
<br><br>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Adresse</th>
        <th>Actions</th>
    </tr>

    @foreach($fournisseurs as $f)
        <tr>
            <td>{{ $f->nom }}</td>
            <td>{{ $f->email }}</td>
            <td>{{ $f->telephone }}</td>
            <td>{{ $f->adresse }}</td>

            <td>
                <a href="/fournisseurs/{{ $f->id }}/edit">Modifier</a>

                <form action="/fournisseurs/{{ $f->id }}" method="POST" style="display:inline;">
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
