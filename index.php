<?php 
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kosova freelance</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <section class="hero">
<nav class="navbar">
  <a href="#" class="navbar-brand">Kosova freelance</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="#" class="nav-link">Explore</a>
    </li>
    <li class="nav-item">
      <a href="seller.php" class="nav-link">Become a seller</a>
    </li>
    <?php if(isset($_SESSION['user_id'])){?>
    <li class="nav-item">
      <button>
      <a href="logout.php" class="nav-link">Log out</a>
      </button>
    </li>
    <?php }else { ?>
    <li class="nav-item">
      <a href="login.php" class="nav-link">Sign in</a>
    </li>
    <li class="nav-item">
      <button>
      <a href="signup.php" class="nav-link">Join</a>
    </button>
    </li>
    <?php } ?>
  </ul>
</nav>
<div class="hero-txt">
  <h1>Kosova freelance</h1>
  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
  <form action="" class='form'>
    <input type="text" placeholder="Find your job now..."></input>
  </form>
</div>
</section>




</body>
</html>
