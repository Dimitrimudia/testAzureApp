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

// Connexion à PostgreSQL sur Cosmos DB
$dbHost = $_ENV['COSMOS_PGSQL_HOST']; // Ex: your-cluster.postgres.cosmos.azure.com
$dbPort = $_ENV['COSMOS_PGSQL_PORT'];
$dbName = $_ENV['COSMOS_PGSQL_DATABASE'];
$dbUser = $_ENV['COSMOS_PGSQL_USER']; // Ex: your_user@your-cluster
$dbPassword = $_ENV['COSMOS_PGSQL_PASSWORD'];

$conn = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPassword sslmode=require");

if (!$conn) {
    die("Connexion à la base de données PostgreSQL échouée.");
}

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
            $fileUploaded = $blobClient->createBlockBlob($containerName, $photoName, $content);

            // Générer le lien du fichier uploadé
            $blobUrl = "https://runnerdb.blob.core.windows.net/$containerName/$photoName";

            // Enregistrer dans la base PostgreSQL
            $query = "INSERT INTO identites (nom, prenom, email, telephone, photo_url) VALUES ($1, $2, $3, $4, $5)";
            $result = pg_query_params($conn, $query, array($nom, $prenom, $email, $telephone, $blobUrl));

            if ($result) {
                echo "<h3>Identité enregistrée avec succès !</h3>";
                echo "Nom: $nom <br>";
                echo "Prénom: $prenom <br>";
                echo "Email: $email <br>";
                echo "Téléphone: $telephone <br>";
                echo "Photo: <a href='$blobUrl' target='_blank'>Voir la photo</a>";
            } else {
                echo "Erreur lors de l'enregistrement dans la base de données.";
            }

        } catch (ServiceException $e) {
            echo "Erreur lors de l'upload : " . $e->getMessage();
        }
    } else {
        echo "Aucun fichier sélectionné ou une erreur s'est produite.";
    }
}

pg_close($conn);
?>
