<?php
// Include the database configuration
include("db_config.php");

// Fetch existing categories from the 'categories' table
$result = $conn->query("SELECT id, name FROM categories");
$categories = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded shadow-md">
            <h1 class="text-4xl font-semibold mb-8">Discover Plants and Trees</h1>

            <!-- Display existing categories as clickable cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php foreach ($categories as $category): ?>
                    <a href="category.php?id=<?= $category['id']; ?>"
                        class="bg-green-200 p-6 rounded-md shadow-md transition-transform transform hover:scale-105">
                        <p class="text-xl font-semibold">
                            <?= $category['name']; ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>