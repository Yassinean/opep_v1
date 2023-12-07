<?php
include './connect.php';
$title = 'Accueil';
include './tmp/head.php';

?>

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
            $result = mysqli_query($conn, "SELECT * FROM categorie");

            if(mysqli_num_rows($result) > 0) {
                while($category = mysqli_fetch_assoc($result)) {
                    echo '<div class="category-card bg-white rounded-md shadow-md p-4 m-4 transition duration-300 transform hover:scale-105">';
                    echo '<a href="products.php?category_id='.$category['idCategorie'].'">';
                    echo '<h3 class="text-lg font-semibold text-gray-800 mt-2">'.$category['nomCateorie'].'</h3>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-gray-800">No categories found.</p>';
            }
            ?>
        </div>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM plante");

        if($result->num_rows > 0) {
            while($product = $result->fetch_assoc()) {
                
              
                echo '<div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">';
                echo '<img class="w-full h-48 object-cover" src="./admin/uploads/product_images/'.$product['image'].'" alt="Product Image">';
                echo '<div class="px-6 py-4">';
                echo '<div class="font-bold text-xl mb-2">'.$product['nom'].'</div>';
                echo '<p class="text-gray-700 text-base">'.$product['prix'].'</p>';
                echo '<p class="text-gray-900 text-xl mt-2">'.$product['nom'].' DH</p>';
                echo '<form method="post" action="addToCart.php">';
                echo '<input type="hidden" name="productId" value="'.$product['idPlante'].'">';
                echo '<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4" type="submit" name="addToCart">Add to Cart</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        }

        $conn->close();
        ?>
    </main>
</body>

</html>