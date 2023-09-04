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
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <section class="login">
        <!-----------Navbar-->
        <nav class="navbar">
  <a href="index.php" class="navbar-brand">Kosova freelance</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="explore.php" class="nav-link">Explore</a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">Become a seller</a>
    </li>
    <li class="nav-item">
      <a href="login.php" class="nav-link">Sign in</a>
    </li>
    <li class="nav-item">
      <button>
      <a href="signup.php" class="nav-link">Join</a>
    </button>
    </li>
  </ul>
</nav>
<!-----------------Sign up form-------------->
<div class="container">
    <h2>Sign Up</h2>
    <form action="signup_logic.php" method="post" enctype="multipart/form-data">
        <input type="text" id="signupUsername" name="signupUsername" required placeholder="Username">
        <input type="email" id="signupEmail" name="signupEmail" required placeholder="Email">
        <input type="password" id="signupPassword" name="signupPassword" required placeholder="Password">
        <label for="signupProfilePic">Profile Picture</label>
        <input class="file-input"type="file" id="signupProfilePic" name="signupProfilePic">
        <label for="signupLocation">Location</label>
        <select id="signupLocation" name="signupLocation">
            <option value="pristina">Pristina</option>
            <option value="prizren">Prizren</option>
            <option value="gjilan">Gjilan</option>
            <option value="peja">Peja</option>
        </select>
       
        <label for="signupUserRole">Choose User Role</label>
        <select id="signupUserRole" name="signupUserRole">
            <option value="user">I'm hunting</option>
            <option value="hiring">I'm hiring</option>
        </select>
        <button type="submit">Sign Up</button>
    </form>

    <p>Have an account?</p>
    <button><a href="login.php">Log in</a></button>
    </section>
</div>
</body>
</html>