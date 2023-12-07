<?php
include '../connect.php';

if(isset($_POST["addProduct"])) {
    $productName = $_POST["productName"];
    $productCategory = $_POST["productCategory"];
    $productPrice = $_POST["productPrice"];


    $img_name = $_FILES['productImage']['name'];
    $img_size = $_FILES['productImage']['size'];
    $tmp_name = $_FILES['productImage']['tmp_name']; //path
    $error = $_FILES['productImage']['error'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
    $img_upload_path = './uploads/product_images/'.$new_img_name;
    move_uploaded_file($tmp_name, $img_upload_path);

    $stmt = $conn->prepare("INSERT INTO plante (nom, prix, image, idCategorie) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("sisi", $productName, $productPrice, $new_img_name, $productCategory);

    if($stmt->execute()) {
        header("Location: dashboard.php?added=success");
        exit();
    } else {
        echo "Error executing query: ".$stmt->error;
    }

    $stmt->close();

} else {
    header("Location: dashboard.php?error=upload_error");
    exit();
}


