<?php
session_start();
include('../db.php'); // Include database connection

// Collect form data
$project_id = $_POST['project_id'];
$receiver_email = $_POST['receiver_email'];
$sender_email = $_SESSION['email']; // Get the logged-in user's email
$message_content = htmlspecialchars($_POST['message_content'], ENT_QUOTES, 'UTF-8');

// Insert the message into the database
$query = "INSERT INTO messages (sender_email, receiver_email, project_id, message_content) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssis", $sender_email, $receiver_email, $project_id, $message_content);

if ($stmt->execute()) {
    header("Location: ../checkProject.php?message=Message sent successfully!&status=success");
} else {
    header("Location: ../checkProject.php?message=Failed to send message!&status=danger");
}
exit();
?>
