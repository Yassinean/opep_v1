<?php
include '../connect.php';
if(isset($_POST['editCategory'])) {
    $categoryId = $_POST['adminCategoryId'];
    $nameCtg = $_POST['categoryName'];
    $stmt = mysqli_prepare($conn, "UPDATE categorie SET nomCateorie = ?  WHERE idCategorie = ?");
    $stmt->bind_param("si", $nameCtg, $categoryId);
    $stmt->execute();
}
header("Location: dashboard.php");
exit();

?>