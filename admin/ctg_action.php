<?php
include '../connect.php';

if (isset($_POST['deleteCategory'])) {
    $categoryId = $_POST['categoryId'];

    $req = "SELECT id FROM plante WHERE categorieID = ?";
    $sql = mysqli_prepare($conn,$req);

    if ($sql) {
        $sql->bind_param('i', $categoryId);
        $sql->execute();
        $sql->store_result();

        if ($sql->num_rows > 0) {
            $req1 = "DELETE FROM plante WHERE categorieID = ?";
            $sql1 = $conn->prepare($req1);

            if ($sql1) {
                $sql1->bind_param('i', $categoryId);
                $sql1->execute();
                $sql1->close();

                $req3 = "DELETE FROM categorie WHERE id = ?";
                $stmt = $conn->prepare($req3);

                if ($stmt) {
                    $stmt->bind_param('i', $categoryId);
                    $stmt->execute();
                    $stmt->close();

                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Error preparing delete statement for category: " . $conn->error;
                }
            } else {
                echo "Error preparing delete statement for plante records: " . $conn->error;
            }
        } else {
            $deleteCategoryQuery = "DELETE FROM categorie WHERE id = ?";
            $stmt = $conn->prepare($deleteCategoryQuery);

            if ($stmt) {
                $stmt->bind_param('i', $categoryId);
                $stmt->execute();
                $stmt->close();

                // Redirect back to the dashboard after deletion
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error preparing delete statement for category: " . $conn->error;
            }
        }

        $sql->close();
    } else {
        echo "Error preparing statement to check related records: " . $conn->error;
    }
} else {
    // If the form is not submitted, redirect to the dashboard
    header("Location: dashboard.php");
    exit();
}
?>
