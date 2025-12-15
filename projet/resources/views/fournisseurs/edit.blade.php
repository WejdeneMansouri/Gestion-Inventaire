<!DOCTYPE html>
<html>
<head>
    <title>Modifier fournisseur</title>
</head>
<body>

<h1>Modifier fournisseur : {{ $fournisseur->nom }}</h1>

<form action="/fournisseurs/{{ $fournisseur->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nom :</label>
    <input type="text" name="nom" value="{{ $fournisseur->nom }}"><br><br>

    <label>Email :</label>
    <input type="email" name="email" value="{{ $fournisseur->email }}"><br><br>

    <label>Téléphone :</label>
    <input type="text" name="telephone" value="{{ $fournisseur->telephone }}"><br><br>

    <label>Adresse :</label>
    <input type="text" name="adresse" value="{{ $fournisseur->adresse }}"><br><br>

    <button type="submit">Mettre à jour</button>
</form>

</body>
</html>
