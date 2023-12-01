<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "opep_v1";

// Création de la connexion
$conn = mysqli_connect($host, $user, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
echo "Connexion réussie";

// Fermeture de la connexion
$conn->close();
