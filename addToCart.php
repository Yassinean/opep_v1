<?php

include './connect.php';  
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    session_start();

    $sqlSele = "SELECT * FROM panierplante WHERE plante_id = $productId";
    $result = mysqli_query($conn, $sqlSele);

    if(mysqli_num_rows($result) > 0) {
        if($row = mysqli_fetch_assoc($result)) {
            $qt = $row['quantite'];
            $qt++;

            $sqlUpd = "UPDATE panierplante SET quantite = $qt WHERE plante_id = $productId";
            $resultUpd = mysqli_query($conn, $sqlUpd);
            header('Location: home.php?Added =success');

        }
    } else {

        $req = "INSERT INTO panierplante (plante_id, panier_id) VALUES (?, ?)";
        $sql = mysqli_prepare($conn, $req);

        if($sql) {
            $sql->bind_param("ii", $productId, $_SESSION['idPanier']);
            $sql->execute();
            $sql->close();

            header('Location: home.php?Added =success');
        } else {
            echo "Error in prepared statement.";
        }
        $conn->close();
    }
} else {
    echo "Product ID not provided.";
}
?>
