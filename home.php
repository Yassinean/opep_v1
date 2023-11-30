<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-100">

 <?php
    include './tmp/header.php';
 ?>

        <main class="flex flex-wrap justify-around p-4">
            <div class="block">
                <h2 class="text-center text-green-600 text-3xl">Categories</h2>
            </div>
            <div class="flex justify-evenly">
            <?php
            include './connect.php';

            $result = $conn->query("SELECT * FROM categorie");

            if ($result->num_rows > 0) {
                while ($category = $result->fetch_assoc()) {
                    echo '<div class="category-card bg-white rounded-md shadow-md p-4 m-4 transition duration-300 transform hover:scale-105">';
                    echo '<a href="products.php?category_id=' . $category['id'] . '">';
                    echo '<img src="admin/' . $category['ctg_img_path'] . '" alt="Category Image" class="w-full h-40 object-cover rounded">';
                    echo '<h3 class="text-lg font-semibold text-gray-800 mt-2">' . $category['ctg_name'] . '</h3>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-gray-800">No categories found.</p>';
            }

            $conn->close();
            ?>
            </div>
        </main>
</body>

</html>