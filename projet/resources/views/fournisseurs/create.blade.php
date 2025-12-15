<!DOCTYPE html>
<html>
<head>
    <title>Ajouter fournisseur</title>
</head>
<body>

<h1>Ajouter un fournisseur</h1>

<form action="/fournisseurs" method="POST">
    @csrf

    <label>Nom :</label>
    <input type="text" name="nom"><br><br>

    <label>Email :</label>
    <input type="email" name="email"><br><br>

    <label>Téléphone :</label>
    <input type="text" name="telephone"><br><br>

    <label>Adresse :</label>
    <input type="text" name="adresse"><br><br>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>
