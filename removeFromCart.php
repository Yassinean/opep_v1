<?php
session_start();


include './connect.php';

$id = $_GET['idPivot'];

$sql = "DELETE FROM panierplante WHERE idPivot = $id";
mysqli_query($conn,$sql);
header('Location: ./home.php?delete=true ');
?>