<?php
include '../connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteProduct"])) {
    // Get the product ID from the form
    $productId = $_POST['productId'];

    // Perform deletion in the cart table first
    $deleteCartQuery = "DELETE FROM cart WHERE product_id = ?";
    $stmtCart = $conn->prepare($deleteCartQuery);

    if ($stmtCart) {
        $stmtCart->bind_param('i', $productId);
        $stmtCart->execute();
        $stmtCart->close();

        // Now, perform deletion in the plante table
        $deleteQuery = "DELETE FROM plante WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);

        if ($stmt) {
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            $stmt->close();

            // Redirect back to the dashboard after deletion
            header("Location: dashboard.php#products");
            exit();
        } else {
            echo "Error preparing delete statement for plante: " . $conn->error;
        }
    } else {
        echo "Error preparing delete statement for cart: " . $conn->error;
    }
} else {
    // If the form is not submitted, redirect to the dashboard
    header("Location: dashboard.php#products");
    exit();
}
?>