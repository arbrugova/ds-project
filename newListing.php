<?php 
session_start();
if(isset($_SESSION['user_id'])){ ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Create New Job Listing</title>
    </head>
    <body>
        <h1>Create a New Job Listing</h1>
        <form action="listingLogic.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>
    
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br><br>
    
            <label for="category">Category:</label>
            <input type="text" id="category" name="category"><br><br>
    
            <label for="location">Location:</label>
            <input type="text" id="location" name="location"><br><br>
    
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline"><br><br>
    
            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary"><br><br>
    
            <button type="submit" name="submit">Create Listing</button>
        </form>
    </body>
    </html>
 <?php }else{ ?>
    <p>Please Log in</p>
    <button><a href="login.php">Log in</a></button>
<?php }
