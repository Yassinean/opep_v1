<?php
// Include the database configuration
include("db_config.php");

// Check if the form to add a product is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_name"])) {
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_description = $_POST["product_description"];
    $category_id = $_POST["category_id"];

    // Upload product image to 'uploads' folder
    $uploads_dir = "uploads/";
    $tmp_name = $_FILES["product_image"]["tmp_name"];
    $image_name = basename($_FILES["product_image"]["name"]);
    move_uploaded_file($tmp_name, "$uploads_dir/$image_name");

    // Insert product data into the 'products' table
    $insert_sql = "INSERT INTO products (name, price, description, image_path, category_id) 
                   VALUES ('$product_name', '$product_price', '$product_description', '$uploads_dir/$image_name', '$category_id')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Product added successfully";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>