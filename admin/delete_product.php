<?php
include '../connect.php';

$idPlante = $_GET['idPlante'];

$Query = "DELETE FROM plante WHERE idPlante = ?";
$stmtCart = $conn->prepare($Query);

if($stmtCart) {
    $stmtCart->bind_param('i', $idPlante);
    $stmtCart->execute();
    $stmtCart->close();
    header("Location: dashboard.php?delete=success");
} else {
    echo "Error preparing delete statement for Plante: ".$conn->error;
}

?>