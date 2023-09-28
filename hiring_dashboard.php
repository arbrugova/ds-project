<?php
session_start();
require_once "db_conn.php";

function getJobListingsByUserId($user_id, $db) {
    $query = $db->prepare('SELECT * FROM hiring_listing WHERE creator_id = :user_id');
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($query->execute()) {
        $job_listings = $query->fetchAll(PDO::FETCH_ASSOC);
        return $job_listings;
    }

    return false;
}

function getUserData($user_id, $db) {
    $query = $db->prepare('SELECT u.username, u.email, u.profile_picture, s.position, s.education, s.degree, s.rate, s.bio FROM users AS u LEFT JOIN seller AS s ON u.id = s.id WHERE u.id = :user_id');
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    return false;
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Assuming you have the user's ID, e.g., from the session
$user_id = $_SESSION['user_id'];

// Fetch user data
$userData = getUserData($user_id, $db);

// Fetch job listings
$job_listings = getJobListingsByUserId($user_id, $db);


$user_id = $_SESSION['user_id'];
$profile_data = getUserData($user_id, $db);
$hiring_listing = getJobListingsByUserId($user_id, $db);
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
                <li>
                <a href="explore.php" class="nav-link">Explore</a>
                </li>
                <?php if(isset($_SESSION['seller-id'])){ ?>
                    <li>
                        <button style="background-color: #007bff; width: 180px; padding-right:10px;">
                            <a href="user_dashboard.php" class="nav-link">User Dashboard</a>
                        </button>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="seller.php" class="nav-link">Become a seller</a>
                    </li>
                <?php } ?>

                <?php if(isset($_SESSION['user_id'])){ ?>
                    <li>
                        <button>
                            <a href="logout.php" class="nav-link">Log out</a>
                        </button>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="login.php" class="nav-link">Sign in</a>
                    </li>
                    <li>
                        <button>
                         <a href="signup.php" class="nav-link">Join</a>
                        </button>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <a href="hiringListing.php" class="createListing-btn">Create Listing</a>
        <section class="dashboard-section">
        <div class="dashboard-sidebar">
            <!---- Profile Picture and User Info ---->
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
                <!--------Education section-------->
                <?php if(isset($profile_data['education'])){ ?>
                <div class="user-education">
                    <h1>Education</h1>
                    <p>Univseristy:<?php echo $profile_data['education']?></p>
                    <p>Degree:<?php echo $profile_data['degree']?></p>
                    <p>Skills:</p>
                </div>
                <p>Rate</p>
                <?php } ?>
                <button class="edit-profile-btn"><a href="editProfile.php">Edit Profile</a></button>
            </div>
        </div>
        <div class="dashboard-content">
            <!-- User Dashboard Header with Listings -->
            <div class="dashboard-header">
                <h1>Welcome, <?php echo $profile_data['username']; ?></h1>
                <p>Total Job Listings: <?php echo count($hiring_listing); ?></p>
                <!-- Add more user-specific stats here -->
            </div>
            <!---- List of Users Job Listings ---->
            <div class="job-listings">
                <h2>Your Job Listings</h2>
                <ul class="job-list">
                    <?php if (!empty($hiring_listing)) { ?>
                        <?php foreach ($hiring_listing as $listing) { ?>
                            <li class="job-item">
                                <h3><?php echo $listing['title']; ?></h3>
                                <p class="description"><?php echo $listing['description']; ?></p>
                                <p class="category">Category: <?php echo $listing['category']; ?></p>
                                <p class="location">Location: <?php echo $listing['location']; ?></p>
                                <p class="salary">Salary: $<?php echo number_format($listing['salary'], 2); ?></p>
                                <p class="status">Status: <?php echo $listing['status']; ?></p>
                                <button class="delete-btn"><a href="deleteListing.php?job_id=<?php echo $listing['job_id'];?>">Delete</a></button>
                                <button class="edit-btn"><a href="editListing.php?job_id=<?php echo $listing['job_id'];?>">Edit</a></button>
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

