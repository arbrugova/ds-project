<?php
session_start();
require_once "db_conn.php";

function getJobListingsByUserId($user_id, $db) {
    $query = $db->prepare('SELECT * FROM job_listing WHERE creator_id = :user_id');
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($query->execute()) {
        $job_listings = $query->fetchAll(PDO::FETCH_ASSOC);
        return $job_listings;
    }

    return false;
}

function getUserData($user_id, $db) {
    $query = $db->prepare('SELECT u.username, u.email, p.bio FROM users AS u LEFT JOIN seller AS p ON u.id = p.id WHERE u.id = :user_id');
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    return false;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['user_id'])) {
    $profile_user_id = $_GET['user_id'];

    if ($profile_user_id == $user_id) {
        $is_own_profile = true;
        $profile_data = getUserData($user_id, $db);
        $job_listings = getJobListingsByUserId($user_id, $db); // Fetch job listings for the user's own profile
    } else {
        $is_own_profile = false;
        $profile_data = getUserData($profile_user_id, $db);
        $job_listings = getJobListingsByUserId($profile_user_id, $db); // Fetch job listings for the other user's profile
    }

    if (!$profile_data) {
        echo "Profile not found.";
        exit;
    }
} else {
    echo "No profile to display.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<nav class="navbar">
  <a href="index.php" class="navbar-brand">Kosova freelance</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="explore.php" class="nav-link">Explore</a>
    </li>
    <li class="nav-item">
      <a href="seller.php" class="nav-link">Become a seller</a>
    </li>
    <?php if(isset($_SESSION['user_id'])){?>
      <li class="nav-item">
      <a href="profile.php?user_id=<?php echo $_SESSION['user_id']?>" class="nav-link">Profile</a>
    </li>
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
<section class="profile-section">
    <div class="profile-container">
        <div class="profile-picture"></div>
        <div class="profile-username"><?php echo $profile_data['username']; ?></div>
        <div class="profile-email"><?php echo $profile_data['email']; ?></div>
        <div class="profile-bio"><?php echo $profile_data['bio']; ?></div>
        <!--<div class="ratings">
            <span>Rating: <?php echo $profile_data['rating']; ?></span>
        </div>-->
        <?php if ($is_own_profile) { ?>
            <a href="editProfile.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="edit-button">Edit Profile</a>
        <?php } ?>
        <div class="social-media">
            <a href="#" target="_blank">Facebook</a>
            <a href="#" target="_blank">Twitter</a>
            <a href="#" target="_blank">LinkedIn</a>
            <a href="#" target="_blank">Instagram</a>
        </div>
    </div>
    <div class="recent-listings">
    <h2>Recent Listings</h2>
    <ul class="job-listings">
        <?php foreach ($job_listings as $listing) { ?>
            <li class="job-listing">
                <h3><?php echo $listing['title']; ?></h3>
                <p><?php echo $listing['description']; ?></p>
                <p>Category: <?php echo $listing['category']; ?></p>
                <p>Location: <?php echo $listing['location']; ?></p>
                <p>Salary: $<?php echo number_format($listing['salary'], 2); ?></p>
                <p>Status: <?php echo $listing['status']; ?></p>
                <p>Deadline: <?php echo $listing['deadline']; ?></p>
            </li>
        <?php } ?>
    </ul>
</div>
</section>
</body>
</html>
