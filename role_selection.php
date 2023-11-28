<?php
// Include the database configuration
include("db_config.php");

// Retrieve email from the query parameter
$email = $_GET["email"];

// Process form submission for role selection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_id = $_POST["role"];

    // Update user's role in the database
    $sql = "UPDATE users SET role_id = '$role_id' WHERE email = '$email'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to login.php after selecting the role
        header("Location: login.php?email=$email");
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
    <title>Plant Store - Role Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-semibold mb-6">Role Selection</h1>

            <form action="role_selection.php?email=<?php echo $email; ?>" method="post">
                <div class="mb-4">
                    <label for="role" class="block text-gray-600">Role</label>
                    <select id="role" name="role" class="form-select mt-1 block w-full" required>
                        <option value="1">Client</option>
                        <option value="2">Admin</option>
                    </select>
                </div>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Select Role</button>
            </form>
        </div>
    </div>

</body>

</html>