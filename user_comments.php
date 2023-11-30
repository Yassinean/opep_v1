<?php
session_start();

// Assuming the user ID is passed to this page as a parameter, for example, user_comments.php?userId=39
if (isset($_SESSION['userId'])) {

    include './connect.php';
    $userId = $_SESSION['userId'];

    // Fetch user information
    $userQuery = "SELECT * FROM users WHERE id = ?";
    $userStmt = $conn->prepare($userQuery);

    if ($userStmt) {
        $userStmt->bind_param("i", $userId);
        $userStmt->execute();

        $userResult = $userStmt->get_result();

        if ($userResult->num_rows > 0) {
            $user = $userResult->fetch_assoc();

            // Header
            echo '
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>User Cart</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
            </head>

            <body class="bg-gray-100">
                <header class="bg-green-500 text-white p-4">
                    <div class="container mx-auto flex justify-between">
                        <h1 class="text-2xl font-semibold">Votre Panier</h1>
                        <p class="text-sm">Welcome, ' . $user['firstName'] . ' | <a href="logout.php" class="underline">Logout</a></p>
                        <p class="text-2xl font-semibold"><a href="home.php">Retour au page principale</a></p>
                    </div>
                </header>
                <div class="container mx-auto mt-8">
            ';

            echo '<h2 class="text-3xl font-semibold mb-4">Information d\'utilisateur </h2>';
            echo '<p class="text-gray-600">Votre ID: ' . $user['id'] . '</p>';
            echo '<p class="text-gray-600">Votre Nom: ' . $user['firstName'] . '</p>';
            echo '<p class="text-gray-600">Votre Email: ' . $user['email'] . '</p>';
        } else {
            echo '<p class="text-red-500">No user found for ID ' . $userId . '</p>';
        }

        $userStmt->close();

        // Fetch products in the user's cart
        $cartQuery = "SELECT product_id,userId,plt_name,description,prix,image, plante.id AS planteId,cart.id AS cartId FROM cart JOIN plante ON cart.product_id = plante.id WHERE userId = ?";
        $cartStmt = $conn->prepare($cartQuery);

        if ($cartStmt) {
            $cartStmt->bind_param("i", $userId);
            $cartStmt->execute();

            $cartResult = $cartStmt->get_result();

            if ($cartResult->num_rows > 0) {
                echo '<h2 class="text-3xl font-semibold mb-4">Products in Cart</h2>';
                while ($row = $cartResult->fetch_assoc()) {
                    echo '<div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">';
                    echo '<img class="w-full h-48 object-cover" src="admin/' . $row['image'] . '" alt="Product Image">';
                    echo '<div class="px-6 py-4">';
                    echo '<p class="text-gray-700">Product ID: ' . $row['product_id'] . '</p>';
                    echo '<p class="text-gray-700">Product Name: ' . $row['plt_name'] . '</p>';
                    // echo '<p class="text-gray-700">Quantity: ' . $row['quantity'] . '</p>';
                    echo '<p class="text-gray-900">Price: ' . $row['prix'] . ' DH</p>';
                    echo '</div>';
                    echo '<div class="px-6 py-4">';
                    echo '<form method="post" action="removeFromCart.php">';
                    echo '<a href="removeFromCart.php?id=' . $row['cartId'] . '" class="bg-red-500 text-white px-4 py-2 rounded" type="submit" name="removeFromCart">Remove from Cart</a>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-gray-500">Cet utilisateur '. $user['firstName'] . ' n\'a pas encore choisi des plantes </p>';
            }

            $cartStmt->close();
        } else {
            echo '<p class="text-red-500">Error in prepared statement for cart: ' . $conn->error . '</p>';
        }
    } else {
        echo '<p class="text-red-500">Error in prepared statement for user: ' . $conn->error . '</p>';
    }

    // Close the database connection
    $conn->close();

    // Closing HTML tags
    echo '</div></body></html>';
} else {
    echo '<p class="text-red-500">User ID not provided.</p>';
}
?>