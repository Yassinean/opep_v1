<?php
include '../connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addCategory"])) {
    // Retrieve category name
    $categoryName = $_POST["categoryName"];

    // Handle image upload
    $uploadDir = "uploads/category_images/";
    $uploadFile = $uploadDir . basename($_FILES["categoryImage"]["name"]);

    if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $uploadFile)) {

        $imagePath = $uploadFile; // Store the file path in the database

        // Insert into the database
        $stmt = $conn->prepare("INSERT INTO categorie (ctg_name, ctg_img_path) VALUES (?, ?)");
        
        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $categoryName, $imagePath);
        $stmt->execute();

        // Redirect or show a success message
        header("Location: dashboard.php");
        exit();
    } else {
        // Handle file upload error
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
