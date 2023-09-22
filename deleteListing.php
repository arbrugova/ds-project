<?php
// Include your database connection code
require_once "db_conn.php";

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    $sql = "DELETE FROM job_listing WHERE job_id = :job_id";
    $stmt = $db->prepare($sql);

    if ($stmt) {
        $stmt->bindParam(":job_id", $job_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Job listing with ID $job_id deleted successfully.";
            header("Location: user_dashboard.php");
            exit;
        } else {
            echo "Job listing with ID $job_id not found or couldn't be deleted.";
        }

        $stmt->closeCursor(); // Close the cursor (optional)
    } else {
        echo "Error preparing the SQL statement: " . $conn->errorInfo()[2];
    }
} else {
    echo "No job_id provided in the URL.";
}

?>
