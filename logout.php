<?php
  session_start();
  unset($_SESSION['email']); 
  session_unset(); 
  session_destroy(); 
  header('Location: ./index.php?message=You have logged out successfully!&status=success');
  exit(); 
?>
