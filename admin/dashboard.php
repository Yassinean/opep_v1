<?php
include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-100">

    <header class="bg-green-400 text-white text-center py-4">
        <h1 class="text-2xl font-bold">Dashboard</h1>
    </header>
    <nav class="bg-green-700 text-white py-2 flex justify-around">
        <a href="#categories" class="mx-2">Categories</a> |
        <a href="#products" class="mx-2">Products</a>
    </nav>

    <section id="categories" class="m-4 p-4 bg-white rounded shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Manage Categories</h2>

        <form method="post" action="./add_category.php" enctype="multipart/form-data" class="mb-4">
            <h3 class="text-xl font-bold mb-2">Add Category</h3>
            <label for="categoryName" class="block text-sm font-medium text-gray-600">Category Name:</label>
            <input type="text" id="categoryName" name="nomCateorie"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
            <button type="submit" name="addCategory"
                class="mt-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-green-400">Add
                Category</button>
        </form>

        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th class="bg-green-700 text-white p-2">ID</th>
                    <th class="bg-green-700 text-white p-2">Name</th>
                    <th class="bg-green-700 text-white p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM categorie ORDER BY idCategorie");
                if($result->num_rows > 0) {
                    while($category = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td class="p-2 text-center">'.$category['idCategorie'].'</td>';
                        echo '<td class="p-2 text-center">'.$category['nomCateorie'].'</td>';
                        echo '<td class="p-2 text-center">';
                        echo '<form method="post" action="ctg_action.php">';
                        echo '<input type="hidden" name="categoryId" value="'.$category['idCategorie'].'">';
                        echo '<div class="button-container">';
                        echo "<a href='./deleteCateg.php?idCateg={$category["idCategorie"]}' name='deleteCategory' class='bg-red-500 text-white px-4 py-2 rounded'>Delete</a>";
                        echo '</div>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No categories found</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <h3 class="text-green-700 text-2xl">Edit Category </h3>

                <form method="post" action="edit_category.php" enctype="multipart/form-data">

                    <label for="adminCategoryId">Enter Category ID:</label>
                    <input class="border" type="number" id="adminCategoryId" name="adminCategoryId" required>

                    <label for="editCategoryName">Category Name:</label>
                    <input class="border" type="text" id="editCategoryName" name="categoryName">



                    <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-green-400" name="editCategory">Save</button>
                </form>
            </div>
        </div>
    </section>

    <section id="products" class="m-4 p-4 bg-white rounded shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Manage Products</h2>
        <table class="w-full mt-4">
            <thead>
                <?php
                echo '<tr>';
                echo '<th class="bg-green-700 text-white p-2">ID</th>';
                echo '<th class="bg-green-700 text-white p-2">Name</th>';
                echo '<th class="bg-green-700 text-white p-2">Price</th>';
                echo '<th class="bg-green-700 text-white p-2">Image</th>';
                echo '<th class="bg-green-700 text-white p-2">Category Name</th>';
                echo '<th class="bg-green-700 text-white p-2">Action</th>';
                echo '</tr>';

                $result = $conn->query("SELECT * FROM plante");

                if($result->num_rows > 0) {
                    while($product = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td class="p-2 text-center">'.$product['idPlante'].'</td>';
                        echo '<td class="p-2 text-center">'.$product['nom'].'</td>';
                        echo '<td class="p-2 text-center">'.$product['prix'].'</td>';
                        echo '<td class="p-2 flex justify-center">';
                        echo '<img src="./uploads/product_images/'.$product['image'].'" alt="Product Image" width="50" class="category-image">';
                        echo '</td>';
                        echo '<td class="p-2 text-center">'.$product['idCategorie'].'</td>';
                        echo '<td class="p-2 text-center">';
                        echo "<a href='./delete_product.php?idPlante={$product["idPlante"]}' name='deleteProduct' class='bg-red-500 text-white px-4 py-2 rounded'>Delete</a>";
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No products found</td></tr>';
                }

                ?>
            </thead>
        </table>
        <section id="products">


            <form method="post" action="add_product.php" enctype="multipart/form-data" class="mt-4">
                <h3 class="text-xl font-bold mb-2">Add Product</h3>
                <label for="productName" class="block text-sm font-medium text-gray-600">Product Name:</label>
                <input type="text" id="productName" name="productName" required
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                <label for="productPrice" class="block text-sm font-medium text-gray-600">Product Price:</label>
                <input type="text" id="productPrice" name="productPrice" required
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                <label for="productImage" class="block text-sm font-medium text-gray-600">Product Image:</label>
                <input type="file" id="productImage" name="productImage"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
                <label for="productCategory" class="block text-sm font-medium text-gray-600">Product Category:</label>
                <select id="productCategory" name="productCategory" required
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                    <?php
                    $result = $conn->query("SELECT * FROM categorie ORDER BY idCategorie ASC");

                    if($result->num_rows > 0) {
                        while($category = $result->fetch_assoc()) {
                            echo '<option value="'.$category['idCategorie'].'">'.$category['nomCateorie'].'</option>';
                        }
                    } else {
                        echo '<option value="" disabled>No categories found</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="addProduct" class="bg-green-500 text-white px-4 py-2 rounded">Add
                    Product</button>
            </form>

        </section>
        <br>
        <hr>
        <br>
        <hr>
        <br>
        <hr>
        <br>
        <hr>
        <br>
        <hr>
        <br>
        <hr>
        <br>
        <form method="post" action="edit_product.php" enctype="multipart/form-data">
            <h3 class="text-xl font-bold mb-2">EDIT Product</h3>
            <label for="editProductID" class="block text-sm font-medium text-gray-600">Product ID:</label>
            <input type="number" id="editProductID" name="editProductID" required
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            <label for="editProductName" class="block text-sm font-medium text-gray-600">Product Name:</label>
            <input type="text" id="editProductName" name="editProductName"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">

            <label for="editProductPrice" class="block text-sm font-medium text-gray-600">Product Price:</label>
            <input type="number" id="editProductPrice" name="editProductPrice"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">

            <label for="editProductImage" class="block text-sm font-medium text-gray-600">Product Image:</label>
            <input type="file" id="editProductImage" name="editProductImage"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">

            <label for="editProductCategory" class="block text-sm font-medium text-gray-600">Product Category:</label>
            <select id="editProductCategory" name="editProductCategory"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                <?php
                $result = mysqli_query($conn, "SELECT * FROM categorie ORDER BY idCategorie  ASC");
                if($result->num_rows > 0) {
                    while($category = $result->fetch_assoc()) {
                        echo '<option value="'.$category['idCategorie'].'">'.$category['nomCateorie'].'</option>';
                    }
                } else {
                    echo '<option value="" disabled>No categories found</option>';
                }
                ?>
            </select>

            <button type="submit" name="editProduct" class="bg-green-500 text-white px-4 py-2 rounded">Edit
                Product</button>
        </form>
    </section>

</body>

</html>