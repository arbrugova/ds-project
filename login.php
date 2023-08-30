<?php
session_start();
if (isset($_SESSION['user_id'])) {
   
    $userRole = $_SESSION['user_type'];

if ($userRole == 'admin') {
    header("Location: admin_dashboard.php");
    exit();
} elseif ($userRole == 'hiring') {
    header("Location: hiring_dashboard.php");
    exit();
} else {
    header("Location: user_dashboard.php");
    exit();
}
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
</head>
<body>
<?php if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
    echo "Registration successful. You can now log in.";
} ?>
    <div class="container">
        <h2>Login</h2>
        <form action="login_logic.php" method="post">
            <div class="form-group">
                <label for="loginUsername">Username</label>
                <input type="text" id="loginUsername" name="loginUsername" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="loginPassword" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
