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

        <form action="hiringListingLogic.php" method="POST" class="container">
        <h2>Create Job Listing</h2>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <textarea id="description" name="description" rows="4" required></textarea>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" required>
            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" step="0.01" required>
        <button type="submit">Create Listing</button>
    </form>
</section>
</body>
</html>
