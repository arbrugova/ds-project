<?php
session_start();

require_once "db_conn.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$query = $db->prepare('SELECT * FROM job_listing');

if ($query->execute()) {
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        $jobListings = $result;
    }
} else {
    echo "Query execution failed: " . $query->errorInfo()[2];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Job Listings</title>
</head>
<body>
  <section class="explore">
    <!-----Navbar----->
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

    <div class="job-listings">
      <ul class="job-list">
          <h2>Job Listings</h2>
          <p>Total listings: <?php echo count($jobListings);?></p>
            <?php if (!empty($jobListings)) { ?>
                <?php foreach ($jobListings as $item) { ?>
                    <li class="job-item">
                        <h3><?php echo $item['title']; ?></h3>
                        <p class="description"><?php echo $item['description']; ?></p>
                        <p class="category">Location: <?php echo $item['location']; ?></p>
                        <p class="category">Created: <?php echo $item['created_at']; ?></p>
                        <p class="category">Deadline: <?php echo $item['deadline']; ?></p>
                        <p class="status"><?php echo $item['status']; ?></p>
                        <button class="apply-btn"><a href="application.php?job_id=<?php echo $item['job_id']; ?>">Apply</a></button>
                        <p class="category">Salary: <?php echo $item['salary']; ?></p>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <p class="no-listings">No job listings found.</p>
            <?php } ?>
        </ul>
    </div>
  </section>
</body>
</html>
