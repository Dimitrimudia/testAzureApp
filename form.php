<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Identification Client</title>
</head>
<body>

<header>
    <h1>Identification Client</h1>
</header>

<div class="container">
    <h2>Formulaire d'identification</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Adresse Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" required>

        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo" accept="image/*" capture="user" required>

        <button type="submit">Soumettre</button>
    </form>
</div>

</body>
</html>
