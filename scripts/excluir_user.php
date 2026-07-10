<?php

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["search"])) {
        $search = $_POST["search"];

        // Prepare the SQL statement to delete the user
        $sql = "DELETE FROM usuarios WHERE usuario = :usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $search, PDO::PARAM_STR);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the admin page after deletion
            header("Location: ../Admin/?message=user_deleted");
            exit();
        } else {
            // Handle error if deletion fails
            header("Location: ../Admin/?error=deletion_failed");
            exit();
        }
    } else {
        // Handle case where 'search' parameter is not set
        header("Location: ../Admin/?error=missing_parameter");
        exit();
    }
} else {
    // Handle case where request method is not POST
    header("Location: ../Admin/?error=invalid_request");
    exit();
}