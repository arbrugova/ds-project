<?php
session_start(); 

require_once "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $id = $_SESSION['user_id'];
        $title = $_POST['title'];
        $education = $_POST['education'];
        $degree = $_POST['degree'];
        $rate = $_POST['rate'];

        $query = "INSERT INTO seller (id, position, education, degree, rate) 
                  VALUES (:id, :position, :education, :degree, :rate)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":position", $title);
        $stmt->bindParam(":education", $education);
        $stmt->bindParam(":degree", $degree);
        $stmt->bindParam(":rate", $rate);

        if ($stmt->execute()) {
            echo "Success";
            header("Location: index.php");
        } else {
            echo "Error occurred during registration (location).";
        }
} else {
    echo "Error occurred during registration (user).";
}
?>
