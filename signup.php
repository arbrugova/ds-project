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
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Sign Up</h2>
    <form action="signup_logic.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="signupUsername">Username</label>
            <input type="text" id="signupUsername" name="signupUsername" required>
        </div>
        <div class="form-group">
            <label for="signupEmail">Email</label>
            <input type="email" id="signupEmail" name="signupEmail" required>
        </div>
        <div class="form-group">
            <label for="signupPassword">Password</label>
            <input type="password" id="signupPassword" name="signupPassword" required>
        </div>
        <div class="form-group">
            <label for="signupProfilePic">Profile Picture</label>
            <input type="file" id="signupProfilePic" name="signupProfilePic">
        </div>
        
        <div class="form-group">
            <label for="signupLocation">Location</label>
            <select id="signupLocation" name="signupLocation">
                <option value="north">North</option>
                <option value="south">South</option>
                
            </select>
        </div>
       
        
        <div class="form-group">
    <label for="signupUserRole">Choose User Role</label>
    <select id="signupUserRole" name="signupUserRole">
        <option value="user">I'm hunting</option>
        <option value="hiring">I'm hiring</option>
    </select>
</div>

        <button type="submit">Sign Up</button>
    </form>
</div>
</body>
</html>