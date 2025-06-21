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
    die("Connexion échouée.");
}

$sql = "CREATE TABLE IF NOT EXISTS identites (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telephone VARCHAR(20),
    photo_url TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$result = pg_query($conn, $sql);

if ($result) {
    echo "Table 'identites' créée avec succès.";
} else {
    echo "Erreur lors de la création de la table.";
}

pg_close($conn);
?>
