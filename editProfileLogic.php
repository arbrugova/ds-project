<?php
session_start();
require_once "db_conn.php";

if (isset($_POST['editUsername']) || isset($_POST['editEmail']) || isset($_POST['editBio']) || isset($_POST['newPassword']) || isset($_POST['confirmPassword'])) {
    $sql = "UPDATE users SET ";
    $updates = array();

    if (isset($_POST['editUsername'])) {
        $newUsername = $_POST['editUsername'];
        $updates[] = "username = :newUsername";
    }

    if (isset($_POST['editEmail'])) {
        $newEmail = $_POST['editEmail'];
        $updates[] = "email = :newEmail";
    }

    if (isset($_POST['editBio'])) {
        $newBio = $_POST['editBio'];
        $updates[] = "bio = :newBio";
    }

    // Check if new password and confirmation match
    if (isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updates[] = "password = :hashedPassword";
        } else {
            echo "Passwords do not match.";
            exit();
        }
    }

    $sql .= implode(", ", $updates);
    $sql .= " WHERE id = :userId";

    $userId = $_SESSION['user_id'];
    $stmt = $db->prepare($sql);

    if (isset($_POST['editUsername'])) {
        $stmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
    }

    if (isset($_POST['editEmail'])) {
        $stmt->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
    }

    if (isset($_POST['editBio'])) {
        $stmt->bindParam(':newBio', $newBio, PDO::PARAM_STR);
    }

    if (isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
        $stmt->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
    }

    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: editProfile.php?edit=success"); 
        exit();
    } else {
        echo "Error updating profile. Please try again.";
    }
} else {
    header("Location: editProfile.php"); 
    exit();
}
