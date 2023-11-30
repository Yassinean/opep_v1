<?php
include '../connect.php';

// Check if the form is submitted
if (isset($_POST['deleteCategory'])) {
    // Get the category ID from the form
    $categoryId = $_POST['categoryId'];

    // Check for related records in the plante table
    $checkPlanteQuery = "SELECT id FROM plante WHERE categorieID = ?";
    $checkPlanteStmt = $conn->prepare($checkPlanteQuery);

    if ($checkPlanteStmt) {
        $checkPlanteStmt->bind_param('i', $categoryId);
        $checkPlanteStmt->execute();
        $checkPlanteStmt->store_result();

        // If there are related records in the plante table
        if ($checkPlanteStmt->num_rows > 0) {
            // Handle the deletion or update of related records in plante table
            // For example, you might delete the related records:
            $deletePlanteQuery = "DELETE FROM plante WHERE categorieID = ?";
            $deletePlanteStmt = $conn->prepare($deletePlanteQuery);

            if ($deletePlanteStmt) {
                $deletePlanteStmt->bind_param('i', $categoryId);
                $deletePlanteStmt->execute();
                $deletePlanteStmt->close();

                // Proceed with deleting the category after handling related records
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
            } else {
                echo "Error preparing delete statement for plante records: " . $conn->error;
            }
        } else {
            // No related records in the plante table, proceed with deleting the category
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

        $checkPlanteStmt->close();
    } else {
        echo "Error preparing statement to check related records: " . $conn->error;
    }
} else {
    // If the form is not submitted, redirect to the dashboard
    header("Location: dashboard.php");
    exit();
}
?>
