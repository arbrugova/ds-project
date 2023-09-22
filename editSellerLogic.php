<?php
session_start();
require_once "db_conn.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $education = $_POST['education'];
    $degree = $_POST['degree'];

    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE seller 
            SET education = :education, 
                degree = :degree
            WHERE id = :user_id";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':education', $education);
    $stmt->bindParam(':degree', $degree);
    $stmt->bindParam(':user_id', $user_id);

    try {
        $stmt->execute();
        echo "Education information updated successfully!";
        header("Location: user_dashboard.php"); // Redirect to the user dashboard
    } catch (PDOException $e) {
        echo "Error updating education information: " . $e->getMessage();
    }
} 
?>
