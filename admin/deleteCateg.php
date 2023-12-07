
<?php
include '../connect.php';
$idCateg = $_GET['idCateg'];

$Query = "DELETE FROM categorie WHERE idCategorie = ?";
$stmtCart = $conn->prepare($Query);

if($stmtCart) {
    $stmtCart->bind_param('i', $idCateg);
    $stmtCart->execute();
    $stmtCart->close();
    header("Location: dashboard.php?delete=success");
} else {
    echo "Error preparing delete statement for categ: ".$conn->error;
}

?>