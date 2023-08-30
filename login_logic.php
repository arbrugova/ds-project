<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    require_once 'db_conn.php';

    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];

    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $loginUsername);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($loginPassword, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];

        if ($user['user_type'] == 'admin') {
            header("Location: admin_dashboard.php");
            exit();
        } elseif ($user['user_type'] == 'hiring') {
            header("Location: hiring_dashboard.php");
            exit();
        } else {
            header("Location: user_dashboard.php");
            exit();
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>
