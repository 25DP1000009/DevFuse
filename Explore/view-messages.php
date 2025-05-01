<?php
session_start();
include('../db.php'); // Database connection

$receiver_email = $_SESSION['email']; // Logged-in user's email
$query = "SELECT * FROM messages WHERE receiver_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $receiver_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Messages</title>
</head>
<body>
  <h2>Messages for Your Projects</h2>
  <?php while ($row = $result->fetch_assoc()) { ?>
    <div>
      <p><strong>From:</strong> <?php echo $row['sender_email']; ?></p>
      <p><strong>Message:</strong> <?php echo $row['message_content']; ?></p>
      <p><strong>Project ID:</strong> <?php echo $row['project_id']; ?></p>
      <hr>
    </div>
  <?php } ?>
</body>
</html>
