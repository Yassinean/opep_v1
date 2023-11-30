<?php
include '../connect.php';
include("add_category.php");
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

    <!-- Section for Managing Categories -->
    <section id="categories" class="m-4 p-4 bg-white rounded shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Manage Categories</h2>

        <!-- Form to Add Category -->
        <form method="post" action="" enctype="multipart/form-data" class="mb-4">
            <h3 class="text-xl font-bold mb-2">Add Category</h3>
            <!-- Other category fields -->
            <label for="categoryName" class="block text-sm font-medium text-gray-600">Category Name:</label>
            <input type="text" id="categoryName" name="categoryName"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
            <!-- Image upload -->
            <label for="categoryImage" class="block text-sm font-medium text-gray-600">Category Image:</label>
            <input type="file" id="categoryImage" name="categoryImage" accept="image/*" required
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            <button type="submit" name="addCategory"
                class="mt-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-green-400">Add
                Category</button>
        </form>

        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th class="bg-green-700 text-white p-2">ID</th>
                    <th class="bg-green-700 text-white p-2">Name</th>
                    <th class="bg-green-700 text-white p-2">Image</th>
                    <th class="bg-green-700 text-white p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display categories goes here -->
                <?php
                // Fetch all categories from the database ordered by ID
                $result = mysqli_query($conn, "SELECT * FROM categorie ORDER BY id ASC");

                // Check if there are any categories
                if ($result->num_rows > 0) {
                    // Categories found, loop through each category
                    while ($category = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td class="p-2 text-center">' . $category['id'] . '</td>';
                        echo '<td class="p-2 text-center">' . $category['ctg_name'] . '</td>';
                        echo '<td class="p-2 flex justify-center">';
                        echo '<img src="' . $category['ctg_img_path'] . '" width="50" alt="Category Image" class="category-image">';
                        echo '</td>';
                        echo '<td class="p-2 text-center">';
                        echo '<form method="post" action="ctg_action.php">';
                        echo '<input type="hidden" name="categoryId" value="' . $category['id'] . '">';
                        echo '<div class="button-container">';
                        echo '<button type="submit" name="deleteCategory" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>';
                        echo '</div>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    // No categories found
                    echo '<tr><td colspan="4">No categories found</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- Edit Category Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <h3 class="text-green-700 text-2xl">Edit Category :v</h3>

                <form method="post" action="edit_category.php" enctype="multipart/form-data">

                    <label for="adminCategoryId">Enter Category ID:</label>
                    <input type="number" id="adminCategoryId" name="adminCategoryId" required>

                    <label for="editCategoryName">Category Name:</label>
                    <input type="text" id="editCategoryName" name="categoryName">

                    <label for="editCategoryImage">Category Image:</label>
                    <input type="file" id="editCategoryImage" name="categoryImage">

                    <button type="submit" class="text-green-800" name="editCategory">Save</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Section for Managing Products -->
    <section id="products" class="m-4 p-4 bg-white rounded shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Manage Products</h2>
        <table class="w-full mt-4">
            <thead>
                <?php
                // Section for Managing Products
                echo '<tr>';
                echo '<th class="bg-green-700 text-white p-2">ID</th>';
                echo '<th class="bg-green-700 text-white p-2">Name</th>';
                echo '<th class="bg-green-700 text-white p-2">Description</th>';
                echo '<th class="bg-green-700 text-white p-2">Price</th>';
                echo '<th class="bg-green-700 text-white p-2">Image</th>';
                echo '<th class="bg-green-700 text-white p-2">Category Name</th>';
                echo '<th class="bg-green-700 text-white p-2">Action</th>';
                echo '</tr>';

                // Fetch and display products
                $result = $conn->query("SELECT * FROM plante");

                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td class="p-2 text-center">' . $product['id'] . '</td>';
                        echo '<td class="p-2 text-center">' . $product['plt_name'] . '</td>';
                        echo '<td class="p-2 text-center">' . $product['description'] . '</td>';
                        echo '<td class="p-2 text-center">' . $product['prix'] . '</td>';
                        echo '<td class="p-2 flex justify-center">';
                        echo '<img src="' . $product['image'] . '" alt="Product Image" width="50" class="category-image">';
                        echo '</td>';
                        echo '<td class="p-2 text-center">' . $product['categorieID'] . '</td>';
                        echo '<td class="p-2 text-center">';
                        echo '<form method="post" action="edit_product.php">';
                        echo '<input type="hidden" name="productId" value="' . $product['id'] . '">';
                        // echo '<button type="submit" name="editProduct" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>';
                        echo '</form>';
                        echo '<form method="post" action="delete_product.php">';
                        echo '<input type="hidden" name="productId" value="' . $product['id'] . '">';
                        echo '<button type="submit" name="deleteProduct" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No products found</td></tr>';
                }

                ?>
            </thead>
            <!-- PHP code to fetch and display products goes here -->
        </table>
        <!-- Section for Managing Products -->
        <section id="products">

            <!-- Form to Add Product -->
            <form method="post" action="add_product.php" enctype="multipart/form-data" class="mt-4">
                <h3 class="text-xl font-bold mb-2">Add Product</h3>
                <!-- Other product fields -->
                <label for="productName" class="block text-sm font-medium text-gray-600">Product Name:</label>
                <input type="text" id="productName" name="productName" required
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                <!-- Other product prix -->
                <label for="productPrice" class="block text-sm font-medium text-gray-600">Product Price:</label>
                <input type="text" id="productPrice" name="productPrice" required
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                <!-- description -->
                <label for="productDescription" class="block text-sm font-medium text-gray-600">Product Description:</label>
                <input type="text" id="productDescription" name="productDescription" required
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                <!-- Image upload for the product -->
                <label for="productImage" class="block text-sm font-medium text-gray-600">Product Image:</label>
                <input type="file" id="productImage" name="productImage"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500" required>
                <!-- Dropdown for product category -->
                <label for="productCategory" class="block text-sm font-medium text-gray-600">Product Category:</label>
                <select id="productCategory" name="productCategory" required
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                    <?php
                    // Fetch all categories from the database ordered by ID
                    $result = $conn->query("SELECT * FROM categorie ORDER BY id ASC");

                    // Check if there are any categories
                    if ($result->num_rows > 0) {
                        // Categories found, loop through each category
                        while ($category = $result->fetch_assoc()) {
                            echo '<option value="' . $category['id'] . '">' . $category['ctg_name'] . '</option>';
                        }
                    } else {
                        // No categories found
                        echo '<option value="" disabled>No categories found</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="addProduct" class="bg-green-500 text-white px-4 py-2 rounded">Add
                    Product</button>
            </form>

        </section>

        <!-- Edit Product Modal -->
        <form method="post" action="edit_product.php" enctype="multipart/form-data">
            <h3 class="text-xl font-bold mb-2">EDIT Product</h3>
            <!-- Other product fields -->
            <label for="editProductID" class="block text-sm font-medium text-gray-600">Product ID:</label>
            <input type="number" id="editProductID" name="editProductID" required
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            <label for="editProductName" class="block text-sm font-medium text-gray-600">Product Name:</label>
            <input type="text" id="editProductName" name="editProductName"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            <label for="editProductDescription" class="block text-sm font-medium text-gray-600">Product
                Description:</label>
            <textarea id="editProductDescription" name="editProductDescription"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500"></textarea>
            <label for="editProductPrice" class="block text-sm font-medium text-gray-600">Product Price:</label>
            <input type="number" id="editProductPrice" name="editProductPrice"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">

            <!-- Image upload for the product -->
            <label for="editProductImage" class="block text-sm font-medium text-gray-600">Product Image:</label>
            <input type="file" id="editProductImage" name="editProductImage"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">

            <!-- Dropdown for product category -->
            <label for="editProductCategory" class="block text-sm font-medium text-gray-600">Product Category:</label>
            <select id="editProductCategory" name="editProductCategory"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
                <?php
                // Fetch all categories from the database ordered by ID
                $result = mysqli_query($conn, "SELECT * FROM categorie ORDER BY id ASC");

                // Check if there are any categories
                if ($result->num_rows > 0) {
                    // Categories found, loop through each category
                    while ($category = $result->fetch_assoc()) {
                        echo '<option value="' . $category['id'] . '">' . $category['ctg_name'] . '</option>';
                    }
                } else {
                    // No categories found
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