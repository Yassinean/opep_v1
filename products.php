<?php
include './connect.php';

$title = 'Products';
include './tmp/head.php';

?>

<body class="font-sans bg-gray-100">

    <header class="bg-green-800 text-white text-center py-4">
        <h1 class="text-2xl font-bold">Products</h1>
        <a href="user_comments.php" class="bg-white text-green-500">>View Your basket< </a>

    </header>
    <div class="my-4 text-center">
        <form method="get" action="products.php">
            <input class="px-4 py-2 border rounded" type="text" placeholder="Search by product name" name="query">
            <button class="px-4 py-2 bg-green-500 text-white rounded" type="submit">Search</button>
        </form>
    </div>

    <main class="flex flex-wrap justify-around p-4">
        <?php
        // session_start();
        if(isset($_GET['query'])) {
            $searchQuery = $_GET['query'];

            $result = mysqli_query($conn, "SELECT * FROM plante WHERE nom LIKE '%$searchQuery%'");

            if($result->num_rows > 0) {
                while($product = $result->fetch_assoc()) {
                    echo '<div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">';
                    echo '<img class="w-full h-48 object-cover" src="./admin/uploads/product_images/'.$product['image'].'" alt="Product Image">';
                    echo '<div class="px-6 py-4">';
                    echo '<div class="font-bold text-xl mb-2">'.$product['nom'].'</div>';
                    echo '<p class="text-gray-900 text-xl mt-2">'.$product['prix'].' DH</p>';
                    echo '<form method="post" action="addToCart.php">';
                    echo '<input type="hidden" name="productId" value="'.$product['idPlante'].'">';
                    echo '<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4" type="submit" name="addToCart">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-xl text-center text-red-500">Aucun produit nommé '.$searchQuery.'.</p>';
            }
        } else {
            if(isset($_GET['category_id'])) {
                $categoryId = $_GET['category_id'];
                $result = mysqli_query($conn, "SELECT * FROM plante WHERE idCategorie = $categoryId");

                if(mysqli_num_rows($result) > 0) {
                    while($product = mysqli_fetch_assoc($result)) {
                        echo '<div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">';
                        echo '<img class="w-full h-48 object-cover" src="admin/'.$product['image'].'" alt="Product Image">';
                        echo '<div class="px-6 py-4">';
                        echo '<div class="font-bold text-xl mb-2">'.$product['nom'].'</div>';
                        echo '<p class="text-gray-900 text-xl mt-2">'.$product['prix'].' DH</p>';
                        echo '<form method="post" action="addToCart.php">';
                        echo '<input type="hidden" name="productId" value="'.$product['idPlante'].'">';
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
        mysqli_close($conn);
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
    </script>  -->
</body>

</html>