    <?php
    // Include the database configuration
    include("db_config.php");

    // Check if the form to add a category is submitted

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["category_name"])) {
        $category_name = $_POST["category_name"];

        // Check if the category already exists
        $check_sql = "SELECT id FROM categories WHERE name = '$category_name'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows == 0) {
            // Category does not exist, proceed with insertion
            $insert_sql = "INSERT INTO categories (name) VALUES ('$category_name')";

            if ($conn->query($insert_sql) === TRUE) {
                echo "Category added successfully";
            } else {
                echo "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        } else {
            echo "Category already exists";
        }
    }


    // Check if the form to edit a category is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_category_id"])) {
        $edit_category_id = $_POST["edit_category_id"];
        $new_name = $_POST["new_name"];

        // Update the category name in the 'categories' table
        $sql = "UPDATE categories SET name = '$new_name' WHERE id = $edit_category_id";

        if ($conn->query($sql) === TRUE) {
            echo "Category updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Check if the form to delete a category is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_category_id"])) {
        $delete_category_id = $_POST["delete_category_id"];

        // Delete the category from the 'categories' table
        $sql = "DELETE FROM categories WHERE id = $delete_category_id";

        if ($conn->query($sql) === TRUE) {
            echo "Category deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

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
        <title>Plant Store - Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-100">

        <div class="container mx-auto mt-8">
            <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

                <!-- Form to add a new category -->
                <form action="dashboard.php" method="post">
                    <div class="mb-4">
                        <label for="category_name" class="block text-gray-600">Category Name</label>
                        <input type="text" id="category_name" name="category_name" class="form-input mt-1 block w-full"
                            required>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</button>
                </form>

                <hr class="my-6">

                <!-- Display existing categories in a table -->
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">Category Name</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td>
                                    <?= $category['id']; ?>
                                </td>
                                <td>
                                    <?= $category['name']; ?>
                                </td>
                                <td>
                                    <!-- Form to edit a category -->
                                    <form action="dashboard.php" method="post" class="inline">
                                        <input type="hidden" name="edit_category_id" value="<?= $category['id']; ?>">
                                        <input type="text" name="new_name" class="form-input" placeholder="New Name" required>
                                        <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                    </form>

                                    <!-- Form to delete a category -->
                                    <form action="dashboard.php" method="post" class="inline">
                                        <input type="hidden" name="delete_category_id" value="<?= $category['id']; ?>">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form to add a new product -->
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="product_name" class="block text-gray-600">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="product_price" class="block text-gray-600">Product Price</label>
                <input type="number" id="product_price" name="product_price" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="product_description" class="block text-gray-600">Product Description</label>
                <textarea id="product_description" name="product_description" class="form-input mt-1 block w-full"
                    required></textarea>
            </div>

            <div class="mb-4">
                <label for="product_image" class="block text-gray-600">Product Image</label>
                <input type="file" id="product_image" name="product_image" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-600">Select Category</label>
                <select id="category_id" name="category_id" class="form-select mt-1 block w-full" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']; ?>">
                            <?= $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add Product</button>
        </form>


    </body>

    </html>

