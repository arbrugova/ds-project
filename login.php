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
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
    echo "Registration successful. You can now log in.";
} ?>
<section class="login">
    <!-------------Navbar------------->
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
<!--------------Login form------------------------>
    <div class="container">
        <h2>Login</h2>
        <form action="login_logic.php" method="post">
            <div class="form-group">
                <input type="text" id="loginUsername" name="loginUsername" required placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" id="loginPassword" name="loginPassword" required placeholder="Password">
            </div>
            <button type="submit">Log in</button>
        </form>
        <p>Don’t have an account?</p>
        <button><a href="signup.php">Sign up</a></button>
    </div>
    </section>
</body>
</html>
