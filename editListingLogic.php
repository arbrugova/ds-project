<?php
session_start();
require_once "db_conn.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = $_POST['job_id']; 

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $location = $_POST['location'];

    $creator_id = $_SESSION['user_id'];

    // Check if the user is the creator of the listing
    $sql = "SELECT * FROM job_listing WHERE job_id = :job_id AND creator_id = :creator_id";
    $stmt_check = $db->prepare($sql);
    $stmt_check->bindParam(':job_id', $job_id); // Fix the variable name here
    $stmt_check->bindParam(':creator_id', $creator_id); // Fix the variable name here

    try {
        $stmt_check->execute();
        $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo "You do not have permission to edit this listing.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error checking listing ownership: " . $e->getMessage();
        exit;
    }

    // Update the existing job listing
    $sql = "UPDATE job_listing 
            SET title = :title, 
                description = :description, 
                category = :category, 
                location = :location
            WHERE job_id = :job_id"; // Update the column name

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':job_id', $job_id); // Fix the variable name here

    try {
        $stmt->execute();
        echo "Job listing updated successfully!";
        header("Location: user_dashboard.php");
    } catch (PDOException $e) {
        echo "Error updating job listing: " . $e->getMessage();
    }
}
?>
