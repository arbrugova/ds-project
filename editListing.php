<?php
session_start();
require_once "db_conn.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your code for updating the job listing (as shown in the previous response)
    // ...

} elseif (isset($_GET['job_id'])) {
    // Fetch the job listing based on the job_id from the URL
    $job_id = $_GET['job_id']; // Get job_id from the URL

    $creator_id = $_SESSION['user_id'];

    // Query to fetch the existing job listing
    $sql = "SELECT * FROM job_listing WHERE job_id = :job_id AND creator_id = :creator_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':job_id', $job_id);
    $stmt->bindParam(':creator_id', $creator_id);

    try {
        $stmt->execute();
        $job_listing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($job_listing) {
            // Populate the form fields with job listing data
            $title = $job_listing['title'];
            $description = $job_listing['description'];
            $category = $job_listing['category'];
            $location = $job_listing['location'];
        } else {
            echo "Job listing not found or you do not have permission to edit it.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error checking listing ownership: " . $e->getMessage();
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job Listing</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <section class="create-listing-section">
    
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

        <form action="editListingLogic.php" method="POST" class="container">
            <h2>Edit Job Listing</h2>
            <input type="hidden" name="job_id" value="<?php echo $job_id ?>">

            <label for="title">Title</label>
            <input type="text" id="title" name="title" required value="<?php echo $title ?>">

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3" required><?php echo $description ?></textarea>

            <label for="category">Category</label>
            <input type="text" id="category" name="category" required value="<?php echo $category ?>">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" required value="<?php echo $location ?>">

            <button type="submit">Update Listing</button>
        </form>
</section>
</body>
</html>
