<?php
require_once 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $signupUsername = $_POST['signupUsername'];
    $signupEmail = $_POST['signupEmail'];
    $signupPassword = password_hash($_POST['signupPassword'], PASSWORD_DEFAULT);
    $userRole = $_POST['signupUserRole'];
    $location = $_POST['signupLocation'];

    
    $query = "INSERT INTO users (username, email, password, user_type) 
              VALUES (:username, :email, :password, :user_type)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $signupUsername);
    $stmt->bindParam(":email", $signupEmail);
    $stmt->bindParam(":password", $signupPassword);
    $stmt->bindParam(":user_type", $userRole);

    if ($stmt->execute()) {
     
        $user_id = $db->lastInsertId();

        $queryUserLocation = "INSERT INTO user_locations (user_id, location_name) 
                              VALUES (:user_id, :location_name)";
        $stmtUserLocation = $db->prepare($queryUserLocation);
        $stmtUserLocation->bindParam(":user_id", $user_id);
        $stmtUserLocation->bindParam(":location_name", $location);

        if ($stmtUserLocation->execute()) {
            $_SESSION['signup_success'] = true;
            header("Location: index.php?signup=success");
        } else {
            echo "Error occurred during registration (location).";
        }
    } else {
        echo "Error occurred during registration (user).";
    }
}
?>
