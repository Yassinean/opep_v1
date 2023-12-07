<?php
include '../connect.php';
include 'dashboard.php';

if(isset($_POST['editProduct'])) {
    $productId = $_POST['editProductID'];
    $productName = $_POST['editProductName'];
    $productPrice = $_POST['editProductPrice'];
    $productCategory = $_POST['editProductCategory'];


    $img_name = $_FILES['editProductImage']['name'];
    $img_size = $_FILES['editProductImage']['size'];
    $tmp_name = $_FILES['editProductImage']['tmp_name']; //path
    $error = $_FILES['editProductImage']['error'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
    $img_upload_path = './uploads/product_images/'.$new_img_name;
    move_uploaded_file($tmp_name, $img_upload_path);


    $stmt = $conn->prepare("UPDATE plante SET nom = ?,  prix = ?, image = ?, idCategorie = ? WHERE idPlante = ?");
    $stmt->bind_param("sisii", $productName, $productPrice, $new_img_name, $productCategory, $productId);
    $stmt->execute();
    echo "<script> window.location.href = 'dashboard.php' </script>";
} else {
    header("Location: dashboard.php?error=failed");
    exit();
}
?>