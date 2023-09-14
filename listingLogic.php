<?php
session_start();
require_once "db_conn.php";
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $deadline = $_POST['deadline'];
    $salary = $_POST['salary'];

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO job_listing (creator_id, title, description, category, location, created_at, deadline, salary, status)
            VALUES (:creator_id, :title, :description, :category, :location, NOW(), :deadline, :salary, 'Open')";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':creator_id', $user_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':deadline', $deadline);
    $stmt->bindParam(':salary', $salary);

    try {
        $stmt->execute();
        echo "Job listing created successfully!";
    } catch (PDOException $e) {
        echo "Error creating job listing: " . $e->getMessage();
    }
}
?>
