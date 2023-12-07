<?php
$pivot = $_GET['idPivot'];
$num = 2;

    include './connect.php';

    $req = "INSERT INTO commande (numCommande,idPivotfk) VALUES ($num, $pivot)";
    $sql = mysqli_query($conn, $req);

    $sql2 = "DELETE FROM panierplante WHERE idPivot = $pivot";
    mysqli_query($conn, $sql2);
    header('Location: ./home.php?command=done');


?>