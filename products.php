<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Include Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-100">

    <header class="bg-green-800 text-white text-center py-4">
        <h1 class="text-2xl font-bold">Products</h1>
        <a href="user_comments.php">>View Your basket<</a>

    </header>

    <!-- Search bar -->
    <div class="my-4 text-center">
        <form method="get" action="products.php">
            <input class="px-4 py-2 border rounded" type="text" placeholder="Search by product name" name="query">
            <button class="px-4 py-2 bg-green-500 text-white rounded" type="submit">Search</button>
        </form>
    </div>

    <main class="flex flex-wrap justify-around p-4">
        <?php
        include './connect.php';
        // session_start();
        // Check if a search query is provided
        if (isset($_GET['query'])) {
            $searchQuery = $_GET['query'];

            // Fetch products based on the search query
            $result = $conn->query("SELECT * FROM plante WHERE plt_name LIKE '%$searchQuery%'");

            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    echo '<div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">';
                    echo '<img class="w-full h-48 object-cover" src="admin/' . $product['image'] . '" alt="Product Image">';
                    echo '<div class="px-6 py-4">';
                    echo '<div class="font-bold text-xl mb-2">' . $product['plt_name'] . '</div>';
                    echo '<p class="text-gray-700 text-base">' . $product['description'] . '</p>';
                    echo '<p class="text-gray-900 text-xl mt-2">$' . $product['prix'] . '</p>';
                    echo '<form method="post" action="addToCart.php">';
                    echo '<input type="hidden" name="productId" value="' . $product['id'] . '">';
                    echo '<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4" type="submit" name="addToCart">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-xl text-center text-gray-700">No products found for the search query.</p>';
            }
        } else {
            // Display products from the specified category
            if (isset($_GET['category_id'])) {
                $categoryId = $_GET['category_id'];
                $result = $conn->query("SELECT * FROM plante WHERE categorieID = $categoryId");

                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        echo '<div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">';
                        echo '<img class="w-full h-48 object-cover" src="admin/' . $product['image'] . '" alt="Product Image">';
                        echo '<div class="px-6 py-4">';
                        echo '<div class="font-bold text-xl mb-2">' . $product['plt_name'] . '</div>';
                        echo '<p class="text-gray-700 text-base">' . $product['description'] . '</p>';
                        echo '<p class="text-gray-900 text-xl mt-2">' . $product['prix'] . ' DH</p>';
                        echo '<form method="post" action="addToCart.php">';
                        echo '<input type="hidden" name="productId" value="' . $product['id'] . '">';
                        echo '<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4" type="submit" name="addToCart">Add to Cart</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-xl text-center text-gray-700">No products found in this category.</p>';
                 }
            } else {
                echo '<p class="text-xl text-center text-gray-700">Invalid category ID.</p>';
            }
        }
        $conn->close();
        ?>
    </main>

    <!-- <script>
        var productCounter = 0;

        function toggleSlider() {
            var slider = document.querySelector('.slider-container');
            slider.style.right = (slider.style.right === '0px' || slider.style.right === '') ? '-300px' : '0';
        }

        function addToCart() {
            // Increment the counter
            productCounter++;

            // Update the counter display
            document.getElementById('productCounter').innerText = productCounter;
        }
    </script> -->
</body>

</html>