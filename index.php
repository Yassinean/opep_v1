<?php
// Include the database configuration
include("db_config.php");

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Insert user data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to role selection page after successful signup
        header("Location: role_selection.php?email=$email");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Plant Store - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-semibold mb-6">Sign Up</h1>

            <form action="index.php" method="post">
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-600">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-gray-600">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-600">Email</label>
                    <input type="email" id="email" name="email" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-600">Password</label>
                    <input type="password" id="password" name="password" class="form-input mt-1 block w-full" required>
                </div>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Sign Up</button>
                <a href="login.php">login</a>
            </form>
        </div>
    </div>

</body>

</html>