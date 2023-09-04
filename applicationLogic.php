<?php
session_start();
require_once "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $job_id = $_POST['job_id'];
    $applicant_id = $_SESSION['user_id'];
    $application_date = $_POST['application_date'];
    $status = $_POST['status'];


    try {
        $sql = "INSERT INTO applicants (job_id, applicant_id, application_date, status)
                VALUES (:job_id, :applicant_id, :application_date, :status)";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':job_id', $job_id);
        $stmt->bindParam(':applicant_id', $applicant_id);
        $stmt->bindParam(':application_date', $application_date);
        $stmt->bindParam(':status', $status);

        $stmt->execute();
        echo "Job application submitted successfully!";
    } catch (PDOException $e) {
        echo "Error submitting job application: " . $e->getMessage();
    }
}
?>
