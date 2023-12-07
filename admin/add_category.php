<?php
include '../connect.php';


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addCategory"])) {
    $categoryName = $_POST["nomCateorie"];

    $stmt = $conn->prepare("INSERT INTO categorie (nomCateorie) VALUES (?)");

    $stmt->bind_param("s", $categoryName);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();

}
?>