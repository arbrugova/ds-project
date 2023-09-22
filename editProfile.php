<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<section class="edit-profile">
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
                <a href="signup.php" class="nav-link">Join</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <h2>Edit Profile</h2>
        <form action="editProfileLogic.php" method="post">
            <div class="form-group">
                <input type="text" id="editUsername" name="editUsername" placeholder="Your new username">
            </div>
            <div class="form-group">
                <input type="email" id="editEmail" name="editEmail" placeholder="Your new email">
            </div>
            <div class="form-group">
                <textarea id="editBio" name="editBio" rows="4" placeholder="Your new bio"></textarea>
            </div>
            <div class="form-group">
                <input id="editPassword" name="editPassword" type="password" placeholder="New Password"></input>
                <input id="editRetypePassword" name="editRetypePassword" type="password" placeholder="Re-type new password"></input>
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
    <div class="container">
        <h2>Edit Education</h2>
        <form action="editSellerLogic.php" method="post">
        <input type="text" id="education" name="education" placeholder="Education">
        
                <select id="degree" name="degree">
                    <option value="bachelor">Bachelor</option>
                    <option value="master">Master</option>
                    <option value="phd">Phd</option>
                 </select>
            <button type="submit">Save Changes</button>
        </form>
    </div>
    
</section>
</body>
</html>
