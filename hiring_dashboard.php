<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
   
    header("Location: index.php");
    exit();
}

$userRole = $_SESSION['user_type'];

if ($userRole !== 'hiring') {
   
    header("Location: index.php");
    exit();
}
if (isset($_POST['logout'])) {
    
    session_unset();
    session_destroy();
    header("Location: index.php"); 
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
    <div>Start Hiring Now</div>
    <form method="post">
        <button type="submit" name="logout">Log out</button>
    </form>
</body>
</html>