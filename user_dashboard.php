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
    $query = $db->prepare('SELECT u.username, u.email, u.profile_picture,p.bio FROM users AS u LEFT JOIN seller AS p ON u.id = p.id WHERE u.id = :user_id');
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
$profile_data = getUserData($user_id, $db);
$job_listings = getJobListingsByUserId($user_id, $db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
    <body>
        <section class="user-dashboard">
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
    <section class="dashboard-section">
        <div class="dashboard-sidebar">
            <!-- Profile Picture and User Info -->
                <img class="profile-picture" src="<?php echo $profile_data['profile_picture']?>"/>
            <div class="profile-info">
                <h2><?php echo $profile_data['username']; ?></h2>
                <p class="email"><?php echo $profile_data['email']; ?></p>
                <p class="bio"><?php echo $profile_data['bio']; ?></p>
                <div class="social-media">
                    <a href="#" target="_blank">Facebook</a>
                    <a href="#" target="_blank">Twitter</a>
                    <a href="#" target="_blank">LinkedIn</a>
                    <a href="#" target="_blank">Instagram</a>
                </div>
                <button><a href="editProfile.php">Edit Profile</a></button>
            </div>
        </div>
        <div class="dashboard-content">
            <!-- User Dashboard Header with Listings -->
            <div class="dashboard-header">
                <h1>Welcome, <?php echo $profile_data['username']; ?></h1>
                <p>Total Job Listings: <?php echo count($job_listings); ?></p>
                <!-- Add more user-specific stats here -->
            </div>
            <!---- List of Users Job Listings ---->
            <div class="job-listings">
                <h2>Your Job Listings</h2>
                <ul class="job-list">
                    <?php if (!empty($job_listings)) { ?>
                        <?php foreach ($job_listings as $listing) { ?>
                            <li class="job-item">
                                <h3><?php echo $listing['title']; ?></h3>
                                <p class="description"><?php echo $listing['description']; ?></p>
                                <p class="category">Category: <?php echo $listing['category']; ?></p>
                                <p class="location">Location: <?php echo $listing['location']; ?></p>
                                <p class="salary">Salary: $<?php echo number_format($listing['salary'], 2); ?></p>
                                <p class="status">Status: <?php echo $listing['status']; ?></p>
                                <p class="deadline">Deadline: <?php echo $listing['deadline']; ?></p>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="no-listings">No job listings found.</p>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
    </section>
</body>
</html>

