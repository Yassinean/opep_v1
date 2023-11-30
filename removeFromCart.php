<?php
session_start();


include './connect.php';

     $id = $_GET['id'];
 
    // Check if the item belongs to the logged-in user
    $sql="DELETE FROM cart WHERE id = $id";
    $conn->query($sql);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

