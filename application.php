<?php
$job_id=$_GET['job_id']
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Application</title>
</head>
<body>
    <h1>Apply for a Job</h1>
    <form action="applicationLogic.php" method="POST">

    <input type="hidden" name="job_id" value="<?php echo $job_id; ?>"> 

        <label for="application_date">Application Date:</label>
        <input type="date" id="application_date" name="application_date" required><br><br>

        <label for="status">Status:</label>
        <input type="text" id="status" name="status" required><br><br>

        <button type="submit" name="submit">Submit Application</button>
    </form>
</body>
</html>
