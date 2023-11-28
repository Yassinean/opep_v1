<?php
// Include the database configuration
include("db_config.php");

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve user data based on the provided email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect based on user's role
            if ($row["role_id"] == 1) {
                // Redirect to client.php for client role
                header("Location: home.php");
                exit();
            } else {
                // Redirect to dashboard.php for admin role
                header("Location: dashboard.php");
                exit();
            }
        } else {
            // Password is incorrect
            echo "Incorrect password";
        }
    } else {
        // User not found
        echo "User not found";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Store - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-semibold mb-6">Login</h1>

            <form action="login.php" method="post">
                <div class="mb-4">
                    <label for="email" class="block text-gray-600">Email</label>
                    <input type="email" id="email" name="email" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-600">Password</label>
                    <input type="password" id="password" name="password" class="form-input mt-1 block w-full" required>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
            </form>
        </div>
    </div>

</body>

</html>