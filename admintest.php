<?php
include 'php/connexion.php';

// Vérifie si l'utilisateur est un administrateur
session_start();
if (!isset($_SESSION['admin'])) {
    // header('Location: signin.php'); // Redirige vers la page de connexion si non authentifié
    // exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement des opérations d'administration ici

    if (isset($_POST['add_product'])) {
        // Assurez-vous de traiter les données du formulaire et d'ajouter le produit à la base de données
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];
        $idCategory = $_POST['idCategory']; // Assurez-vous d'avoir un champ pour la catégorie dans votre formulaire
        $req_insert = "INSERT INTO plantes (nom, prix, description, idCategory) VALUES ('$nom', '$prix', '$description', '$idCategory')";
        mysqli_query($conn, $req_insert);
    }

    if (isset($_POST['update_product'])) {
        // Assurez-vous de traiter les données du formulaire et de mettre à jour le produit dans la base de données
        $idPlantes = $_POST['idPlantes'];
        $nouveauNom = $_POST['nouveauNom'];
        $req_update = "UPDATE plantes SET nom='$nouveauNom' WHERE idPlantes=$idPlantes";
        mysqli_query($conn, $req_update);
    }

    if (isset($_POST['delete_product'])) {
        // Assurez-vous de traiter les données du formulaire et de supprimer le produit de la base de données
        $idPlantes = $_POST['idPlantes'];
        $req_delete = "DELETE FROM plantes WHERE idPlantes=$idPlantes";
        mysqli_query($conn, $req_delete);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>

<body>

    <h1>Admin Page</h1>

    <!-- Formulaire pour l'ajout de produit -->
    <form method="post" action="">
        <label for="nom">Nom du produit:</label>
        <input type="text" name="nom" required>
        <label for="prix">Prix du produit:</label>
        <input type="text" name="prix" required>
        <label for="description">Description du produit:</label>
        <textarea name="description" required></textarea>
        <label for="idCategory">ID de la catégorie:</label>
        <input type="text" name="idCategory" required>
        <button type="submit" name="add_product">Ajouter le produit</button>
    </form>

    <!-- Affichage des produits avec possibilité de modification et suppression -->
    <?php
    $req = "SELECT * FROM plantes";
    $sql = mysqli_query($conn, $req);
    while ($row = mysqli_fetch_array($sql)) { ?>
        <div>
            <p>
                <?= $row['nom'] ?> -
                <?= $row['prix'] ?> DH
            </p>
            <p>
                <?= $row['description'] ?>
            </p>

            <!-- Formulaire pour la modification du produit -->
            <form method="post" action="">
                <input type="hidden" name="idPlantes" value="<?= $row['idPlantes'] ?>">
                <label for="nouveauNom">Nouveau nom:</label>
                <input type="text" name="nouveauNom" required>
                <button type="submit" name="update_product">Modifier</button>
            </form>

            <!-- Formulaire pour la suppression du produit -->
            <form method="post" action="">
                <input type="hidden" name="idPlantes" value="<?= $row['idPlantes'] ?>">
                <button type="submit" name="delete_product">Supprimer</button>
            </form>
        </div>
    <?php } ?>

</body>

</html>
