<?php
require_once 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Remplace par tes informations Azure
$connectionString = $_ENV['AZURE_CONNECTION_STRING'];
$containerName = "photos";

$blobClient = BlobRestProxy::createBlobService($connectionString);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photoTmpPath = $_FILES['photo']['tmp_name'];
        $photoName = uniqid() . '_' . $_FILES['photo']['name'];

        try {
            // Envoyer le fichier dans le conteneur Azure
            $content = fopen($photoTmpPath, "r");
            $blobClient->createBlockBlob($containerName, $photoName, $content);

            // Générer le lien du fichier uploadé
            $blobUrl = "https://TON_COMPTE.blob.core.windows.net/$containerName/$photoName";

            echo "<h3>Fichier uploadé avec succès dans Azure Storage !</h3>";
            echo "Nom: $nom <br>";
            echo "Prénom: $prenom <br>";
            echo "Email: $email <br>";
            echo "Téléphone: $telephone <br>";
            echo "Photo: <a href='$blobUrl' target='_blank'>Voir la photo</a>";

            // Ici tu peux enregistrer les informations et le lien dans ta base de données si tu le souhaites.

        } catch (ServiceException $e) {
            echo "Erreur lors de l'upload : " . $e->getMessage();
        }
    } else {
        echo "Aucun fichier sélectionné ou une erreur s'est produite.";
    }
}
?>
